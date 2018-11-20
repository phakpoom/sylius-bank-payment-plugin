<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Sylius\Component\Resource\Model\AbstractTranslation;

class BankTranslation extends AbstractTranslation implements BankTranslationInterface
{
    /**
     * @var null|int
     */
    private $id;

    /**
     * @var null|string
     */
    private $name;

    /**
     * @return int|null
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
}
