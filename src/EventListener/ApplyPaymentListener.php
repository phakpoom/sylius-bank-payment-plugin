<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\EventListener;

use Payum\Offline\Constants;
use PhpMob\SyliusBankPaymentPlugin\Constants as MyConstants;
use PhpMob\SyliusBankPaymentPlugin\Model\TransactionInterface;
use SM\Factory\FactoryInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Sylius\Component\Payment\Factory\PaymentFactoryInterface;
use Sylius\Component\Payment\PaymentTransitions;
use Sylius\Component\User\Model\UserInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class ApplyPaymentListener
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var PaymentFactoryInterface
     */
    private $paymentFactory;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var FactoryInterface
     */
    private $smFactory;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        PaymentFactoryInterface $paymentFactory,
        TokenStorageInterface $tokenStorage,
        FactoryInterface $smFactory
    )
    {
        $this->orderRepository = $orderRepository;
        $this->paymentFactory = $paymentFactory;
        $this->tokenStorage = $tokenStorage;
        $this->smFactory = $smFactory;
    }

    /**
     * @param ResourceControllerEvent $event
     *
     * @throws \SM\SMException
     */
    public function apply(ResourceControllerEvent $event): void
    {
        $transaction = $event->getSubject();

        if (!$transaction instanceof TransactionInterface) {
            return;
        }

        /** @var OrderInterface $order */
        if (!$order = $this->orderRepository->findOneByNumber($transaction->getOrderNumber())) {
            return;
        }

        $user = $this->getUser();

        // only allow admin to create payment for order.
        if (!$user instanceof AdminUserInterface && $order->getUser() !== $user) {
            throw new NotFoundHttpException(
                sprintf("Order #%s not found for %s's payment.", $order->getNumber(), $user->getUsername())
            );
        }

        /** @var PaymentInterface $payment */
        foreach ($order->getPayments() as $payment) {
            if (PaymentInterface::STATE_NEW === $payment->getState()
                && $payment->getMethod()
                && MyConstants::METHOD_NAME === $payment->getMethod()->getCode()) {
                break;
            }
        }

        if (empty($payment)) {
            $payment = $this->paymentFactory->createNew();
        }

        $payment->setAmount($transaction->getAmount());
        $payment->setCurrencyCode($order->getCurrencyCode());
        $payment->setState(PaymentInterface::STATE_NEW);
        $payment->setDetails([Constants::FIELD_PAID => false, Constants::FIELD_STATUS => Constants::STATUS_PENDING]);

        $order->addPayment($payment);
        $transaction->setPayment($payment);

        $this->smFactory
            ->get($payment, PaymentTransitions::GRAPH)
            ->apply(PaymentTransitions::TRANSITION_PROCESS);
    }

    /**
     * @return null|UserInterface
     */
    private function getUser(): ?UserInterface
    {
        if (!$token = $this->tokenStorage->getToken()) {
            return null;
        }

        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return null;
        }

        return $user;
    }
}
