<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface BankInterface extends
    CodeAwareInterface,
    ResourceInterface,
    TranslatableInterface,
    TimestampableInterface,
    ImageAwareInterface
{
    /**
     * @return null|BankLogoInterface
     */
    public function getLogo(): ?BankLogoInterface;

    /**
     * @param null|BankLogoInterface $logo
     */
    public function setLogo(?BankLogoInterface $logo): void;

    /**
     * @param AccountInterface $account
     */
    public function addAccount(AccountInterface $account): void;

    /**
     * @param AccountInterface $account
     */
    public function removeAccount(AccountInterface $account): void;

    /**
     * @return Collection
     */
    public function getAccounts(): Collection;
}
