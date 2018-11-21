<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Sylius\Component\Core\Model\PaymentInterface as BasePaymentInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\User\Model\UserAwareInterface;

interface TransactionInterface extends
    ResourceInterface,
    TimestampableInterface,
    UserAwareInterface,
    ImageAwareInterface
{
    const STATE_DRAFT = 'draft';
    const STATE_NEW = 'new';
    const STATE_APPROVED = 'approved';
    const STATE_REJECTED = 'rejected';

    /**
     * @return string
     */
    public function getState(): string;

    /**
     * @param string $state
     */

    public function setState(string $state): void;

    /**
     * @return BasePaymentInterface
     */
    public function getPayment(): BasePaymentInterface;

    /**
     * @param BasePaymentInterface $payment
     */
    public function setPayment(BasePaymentInterface $payment): void;

    /**
     * @return SlipInterface
     */
    public function getSlip(): ?SlipInterface;

    /**
     * @param SlipInterface|null $slip
     */
    public function setSlip(?SlipInterface $slip): void;

    /**
     * @return string
     */
    public function getOrderNumber(): ?string;

    /**
     * @param string $orderNumber
     */
    public function setOrderNumber(?string $orderNumber): void;

    /**
     * @return \DateTime
     */
    public function getTransferredAt(): ?\DateTime;

    /**
     * @param \DateTime $transferredAt
     */
    public function setTransferredAt(?\DateTime $transferredAt): void;

    /**
     * @return int
     */
    public function getAmount(): int;

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void;

    /**
     * @return string
     */
    public function getTransactionCode(): ?string;

    /**
     * @param string $transactionCode
     */
    public function setTransactionCode(?string $transactionCode): void;

    /**
     * @return string
     */
    public function getNote(): ?string;

    /**
     * @param string $note
     */
    public function setNote(?string $note): void;

    /**
     * @return null|AccountInterface
     */
    public function getAccount(): ?AccountInterface;

    /**
     * @param AccountInterface $account
     */
    public function setAccount(?AccountInterface $account): void;
}
