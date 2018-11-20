<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Doctrine\Common\Collections\Collection;

interface PaymentInterface
{
    /**
     * {@inheritdoc}
     */
    public function getTransactions(): Collection;

    /**
     * {@inheritdoc}
     */
    public function isBankPaymentMethod(): bool;

    /**
     * {@inheritdoc}
     */
    public function getTotalCompleted(): int;

    /**
     * {@inheritdoc}
     */
    public function getAmount(): int;
}
