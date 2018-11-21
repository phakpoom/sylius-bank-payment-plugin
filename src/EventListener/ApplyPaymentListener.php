<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\EventListener;

use Payum\Offline\Constants;
use PhpMob\SyliusBankPaymentPlugin\Model\TransactionInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Sylius\Component\Payment\Factory\PaymentFactoryInterface;

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

    public function __construct(OrderRepositoryInterface $orderRepository, PaymentFactoryInterface $paymentFactory)
    {
        $this->orderRepository = $orderRepository;
        $this->paymentFactory = $paymentFactory;
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

        $order->addPayment(
            /** @var PaymentInterface $payment */
            $payment = $this->paymentFactory->createWithAmountAndCurrencyCode($subject->getAmount(), $order->getCurrencyCode())
        );

        $payment->setState(PaymentInterface::STATE_NEW);
        $payment->setDetails([Constants::FIELD_PAID => false, Constants::FIELD_STATUS => Constants::STATUS_PENDING]);

        $subject->setPayment($payment);
    }
}
