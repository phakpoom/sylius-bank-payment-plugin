<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface AccountInterface extends
    ResourceInterface,
    TranslatableInterface,
    TimestampableInterface,
    ToggleableInterface
{
    /**
     * @return null|string
     */
    public function getNumber(): ?string;

    /**
     * @param null|string $number
     */
    public function setNumber(?string $number): void;

    /**
     * @return null|BankInterface
     */
    public function getBank(): ?BankInterface;

    /**
     * @param null|BankInterface $bank
     */
    public function setBank(?BankInterface $bank): void;
}
