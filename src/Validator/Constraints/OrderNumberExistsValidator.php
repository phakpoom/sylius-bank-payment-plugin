<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Validator\Constraints;

use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Sylius\Component\User\Model\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OrderNumberExistsValidator extends ConstraintValidator
{
    /**
     * @var OrderRepositoryInterface
     */
    private $repository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(OrderRepositoryInterface $repository, TokenStorageInterface $tokenStorage)
    {
        $this->repository = $repository;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        $value = \trim(\strval($value));

        if (empty($value)) {
            return;
        }

        /** @var OrderInterface $order */
        $order = $this->repository->findOneByNumber($value);
        $user = $this->getUser();

        if (null === $order || (!$user instanceof AdminUserInterface && $order->getUser() !== $user)) {
            $this->context->addViolation($constraint->message, [
                '{{ value }}' => $value,
            ]);
        }
    }

    /**
     * @return null|UserInterface
     */
    private function getUser(): ?UserInterface
    {
        if (!$token = $this->tokenStorage->getToken()) {
            return null;
        }

        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return null;
        }

        return $user;
    }
}
