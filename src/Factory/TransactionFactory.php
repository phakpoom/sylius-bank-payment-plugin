<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Factory;

use PhpMob\SyliusBankPaymentPlugin\Model\TransactionInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Model\ShopUserInterface;

class TransactionFactory implements TransactionFactoryInterface
{
    /**
     * @var string
     */
    private $dataClass;

    public function __construct(string $dataClass)
    {
        $this->dataClass = $dataClass;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(): TransactionInterface
    {
        return new $this->dataClass;
    }

    /**
     * {@inheritdoc}
     */
    public function createNewUserPayment(ShopUserInterface $user, PaymentInterface $payment = null): TransactionInterface
    {
        $transaction = $this->createNew();
        $transaction->setUser($user);

        if ($payment) {
            $transaction->setPayment($payment);
            $payment->setAmount($transaction->getAmount());
        }

        return $transaction;
    }
}
