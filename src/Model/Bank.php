<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;

/**
 * @method BankTranslationInterface getTranslation()
 */
class Bank implements BankInterface, BankTranslationInterface
{
    use TimestampableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var null|int
     */
    private $id;

    /**
     * @var null|string
     */
    private $code;

    /**
     * @var null|BankLogoInterface
     */
    private $logo;

    /**
     * @var Collection|AccountInterface[]
     */
    private $accounts;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->accounts = new ArrayCollection();
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
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return null|BankLogoInterface
     */
    public function getLogo(): ?BankLogoInterface
    {
        return $this->logo;
    }

    /**
     * @param null|BankLogoInterface $logo
     */
    public function setLogo(?BankLogoInterface $logo): void
    {
        $this->logo = $logo;
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
    public function addAccount(AccountInterface $account): void
    {
        if (!$this->accounts->contains($account)) {
            $account->setBank($this);
            $this->accounts->add($account);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAccount(AccountInterface $account): void
    {
        if ($this->accounts->contains($account)) {
            $account->setBank(null);
            $this->accounts->removeElement($account);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage(): ?ImageInterface
    {
        return $this->logo;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage(?ImageInterface $image): void
    {
        $this->logo = $image;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): BankTranslationInterface
    {
        return new BankTranslation();
    }
}
