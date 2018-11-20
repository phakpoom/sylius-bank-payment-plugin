<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Doctrine\Common\Collections\Collection;
use PhpMob\SyliusBankPaymentPlugin\Constants;
use Sylius\Component\Core\Model\Payment as BasePayment;

class Payment extends BasePayment implements PaymentInterface
{
    /**
     * @var Collection|SlipInterface[]
     */
    protected $transactions;

    /**
     * {@inheritdoc}
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    /**
     * {@inheritdoc}
     */
    public function isBankPaymentMethod(): bool
    {
        return Constants::METHOD_NAME === strtolower($this->method->getCode());
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalCompleted(): int
    {
        if ($this->isBankPaymentMethod()) {
            $amount = 0;

            foreach ($this->transactions as $transaction) {
                if (TransactionInterface::STATE_APPROVED === $transaction->getState()) {
                    $amount += $transaction->getAmount();
                }
            }

            return $amount;
        }

        return $this->getAmount();
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount(): int
    {
        return (int)$this->amount;
    }
}
