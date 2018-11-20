<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Validator\Constraints;

use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OrderNumberExistsValidator extends ConstraintValidator
{
    /**
     * @var OrderRepositoryInterface
     */
    private $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        $value = trim($value);

        if (empty($value)) {
            return;
        }

        // TODO: should check some thing eg. state?
        if (!$this->repository->findOneByNumber($value)) {
            $this->context->addViolation($constraint->message, [
                '{{ value }}' => $value,
            ]);
        }
    }
}
