<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Factory;

use PhpMob\SyliusBankPaymentPlugin\Model\TransactionInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface TransactionFactoryInterface extends FactoryInterface
{
    /**
     * @param ShopUserInterface $user
     * @param PaymentInterface|null $payment
     *
     * @return TransactionInterface
     */
    public function createNewUserPayment(ShopUserInterface $user, PaymentInterface $payment = null): TransactionInterface;
}
