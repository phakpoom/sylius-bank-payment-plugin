<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class OrderNumberExists extends Constraint
{
    public $message = 'Order Number was not exists!';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'order_number_exists';
    }
}
