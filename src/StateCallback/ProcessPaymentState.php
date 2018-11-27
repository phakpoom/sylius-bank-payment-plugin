<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\StateCallback;

use PhpMob\SyliusBankPaymentPlugin\Model\TransactionInterface;
use SM\Factory\FactoryInterface;
use Sylius\Component\Payment\PaymentTransitions;

class ProcessPaymentState
{
    /**
     * @var FactoryInterface
     */
    private $smFactory;

    public function __construct(FactoryInterface $smFactory)
    {
        $this->smFactory = $smFactory;
    }

    /**
     * @param TransactionInterface $transaction
     *
     * @throws \SM\SMException
     */
    public function process(TransactionInterface $transaction): void
    {
        if (!$payment = $transaction->getPayment()) {
            return;
        }

        if (TransactionInterface::STATE_REJECTED === $transaction->getState()) {
            $this->smFactory
                ->get($payment, PaymentTransitions::GRAPH)
                ->apply(PaymentTransitions::TRANSITION_CANCEL, true);

        } else {
            $this->smFactory
                ->get($payment, PaymentTransitions::GRAPH)
                ->apply(PaymentTransitions::TRANSITION_COMPLETE, true);
        }
    }
}
