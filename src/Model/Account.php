<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;

/**
 * @method AccountTranslationInterface getTranslation()
 */
class Account implements AccountInterface, AccountTranslationInterface
{
    use TimestampableTrait, ToggleableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var null|string
     */
    private $number;

    /**
     * @var null|BankInterface
     */
    private $bank;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

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
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * {@inheritdoc}
     */
    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    /**
     * {@inheritdoc}
     */
    public function getBank(): ?BankInterface
    {
        return $this->bank;
    }

    /**
     * {@inheritdoc}
     */
    public function setBank(?BankInterface $bank): void
    {
        $this->bank = $bank;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->getTranslation()->setName($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch(): ?string
    {
        return $this->getTranslation()->getBranch();
    }

    /**
     * {@inheritdoc}
     */
    public function setBranch(?string $branch): void
    {
        $this->getTranslation()->setBranch($branch);
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress(): ?string
    {
        return $this->getTranslation()->getAddress();
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress(?string $address): void
    {
        $this->getTranslation()->setAddress($address);
    }

    /**
     * {@inheritdoc}
     */
    public function getNote(): ?string
    {
        return $this->getTranslation()->getNote();
    }

    /**
     * {@inheritdoc}
     */
    public function setNote(?string $note): void
    {
        $this->getTranslation()->setNote($note);
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): AccountTranslationInterface
    {
        return new AccountTranslation();
    }
}
