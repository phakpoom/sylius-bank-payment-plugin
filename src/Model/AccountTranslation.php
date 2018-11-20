<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Sylius\Component\Resource\Model\AbstractTranslation;

class AccountTranslation extends AbstractTranslation implements AccountTranslationInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var null|string
     */
    private $name;

    /**
     * @var null|string
     */
    private $branch;

    /**
     * @var null|string
     */
    private $address;

    /**
     * @var null|string
     */
    private $note;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch(): ?string
    {
        return $this->branch;
    }

    /**
     * {@inheritdoc}
     */
    public function setBranch(?string $branch): void
    {
        $this->branch = $branch;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
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
}
