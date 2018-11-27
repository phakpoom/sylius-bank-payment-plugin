<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\EventListener;

use Payum\Offline\Constants;
use PhpMob\SyliusBankPaymentPlugin\Constants as MyConstants;
use PhpMob\SyliusBankPaymentPlugin\Model\TransactionInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Sylius\Component\Payment\Factory\PaymentFactoryInterface;
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

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        PaymentFactoryInterface $paymentFactory,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->orderRepository = $orderRepository;
        $this->paymentFactory = $paymentFactory;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param ResourceControllerEvent $event
     */
    public function apply(ResourceControllerEvent $event): void
    {
        $subject = $event->getSubject();

        if (!$subject instanceof TransactionInterface) {
            return;
        }

        if ($subject->getPayment()) {
            return;
        }

        /** @var OrderInterface $order */
        if (!$order = $this->orderRepository->findOneByNumber($subject->getOrderNumber())) {
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
                && $payment->getMethod()->getCode() === MyConstants::METHOD_NAME) {
                $payment->setAmount($subject->getAmount());
                $payment->setAmount($order->getCurrencyCode());

                break;
            }
        }

        if (empty($payment)) {
            $payment = $this->paymentFactory->createWithAmountAndCurrencyCode(
                $subject->getAmount(),
                $order->getCurrencyCode()
            );
        }

        $order->addPayment($payment);

        $payment->setState(PaymentInterface::STATE_NEW);
        $payment->setDetails([Constants::FIELD_PAID => false, Constants::FIELD_STATUS => Constants::STATUS_PENDING]);

        $subject->setPayment($payment);
    }

    /**
     * @return null|UserInterface
     */
    private function getUser(): ?UserInterface
    {
        if (!$token = $this->tokenStorage->getToken()) {
            return;
        }

        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        return $user;
    }
}
