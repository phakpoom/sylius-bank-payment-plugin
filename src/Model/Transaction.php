<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Core\Model\PaymentInterface as BasePaymentInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\User\Model\UserInterface;

class Transaction implements TransactionInterface
{
    use TimestampableTrait;

    /**
     * @var null|int
     */
    private $id;

    /**
     * @var string
     */
    private $state = self::STATE_NEW;

    /**
     * @var null|string
     */
    private $orderNumber;

    /**
     * @var null|\DateTime
     */
    private $transferredAt;

    /**
     * @var int
     */
    private $amount = 0;

    /**
     * @var null|string
     */
    private $transactionCode;

    /**
     * @var null|string
     */
    private $note;

    /**
     * @var null|BasePaymentInterface
     */
    private $payment;

    /**
     * @var null|SlipInterface
     */
    private $slip;

    /**
     * @var AccountInterface
     */
    private $account;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var AdminUserInterface
     */
    private $endorser;

    /**
     * @var null|string
     */
    private $rejectReason;

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * {@inheritdoc}
     */
    public function getPayment(): ?BasePaymentInterface
    {
        return $this->payment;
    }

    /**
     * {@inheritdoc}
     */
    public function setPayment(?BasePaymentInterface $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlip(): ?SlipInterface
    {
        return $this->slip;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlip(?SlipInterface $slip): void
    {
        $this->slip = $slip;

        if ($slip) {
            $slip->setOwner($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrderNumber(?string $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransferredAt(): ?\DateTime
    {
        return $this->transferredAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setTransferredAt(?\DateTime $transferredAt): void
    {
        $this->transferredAt = $transferredAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount(): int
    {
        return intval($this->amount);
    }

    /**
     * {@inheritdoc}
     */
    public function setAmount(int $amount = 0): void
    {
        $this->amount = $amount;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionCode(): ?string
    {
        return $this->transactionCode;
    }

    /**
     * {@inheritdoc}
     */
    public function setTransactionCode(?string $transactionCode): void
    {
        $this->transactionCode = $transactionCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * {@inheritdoc}
     */
    public function setNote(?string $note): void
    {
        $this->note = $note;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccount(): ?AccountInterface
    {
        return $this->account;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccount(?AccountInterface $account): void
    {
        $this->account = $account;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(?UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage(): ?ImageInterface
    {
        return $this->getSlip();
    }

    /**
     * {@inheritdoc}
     */
    public function setImage(?ImageInterface $image): void
    {
        $this->setSlip($image);
    }

    /**
     * {@inheritdoc}
     */
    public function getEndorser(): ?AdminUserInterface
    {
        return $this->endorser;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndorser(?AdminUserInterface $endorser): void
    {
        $this->endorser = $endorser;
    }

    /**
     * {@inheritdoc}
     */
    public function getRejectReason(): ?string
    {
        return $this->rejectReason;
    }

    /**
     * {@inheritdoc}
     */
    public function setRejectReason(?string $rejectReason): void
    {
        $this->rejectReason = $rejectReason;
    }
}
