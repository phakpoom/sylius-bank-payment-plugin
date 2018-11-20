<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

interface AccountTranslationInterface extends ResourceInterface
{
    /**
     * @return int
     */
    public function getId(): ?int;

    /**
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void;

    /**
     * @return null|string
     */
    public function getBranch(): ?string;

    /**
     * @param null|string $branch
     */
    public function setBranch(?string $branch): void;

    /**
     * @return null|string
     */
    public function getAddress(): ?string;

    /**
     * @param null|string $address
     */
    public function setAddress(?string $address): void;

    /**
     * @return null|string
     */
    public function getNote(): ?string;

    /**
     * @param null|string $note
     */
    public function setNote(?string $note): void;
}
