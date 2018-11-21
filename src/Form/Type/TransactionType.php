<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Form\Type;

use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TransactionType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderNumber', TextType::class, [
                'required' => true,
                'label' => 'phpmob.form.transaction.order_number',
            ])
            ->add('transferredAt', DateTimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'label' => 'phpmob.form.transaction.transferred_at',
            ])
            ->add('transactionCode', TextType::class, [
                'required' => false,
                'label' => 'phpmob.form.transaction.transaction_code',
            ])
            ->add('amount', MoneyType::class, [
                'required' => true,
                'label' => 'phpmob.form.transaction.amount',
            ])
            ->add('note', TextareaType::class, [
                'required' => false,
                'label' => 'phpmob.form.transaction.note',
            ])
            ->add('account', AccountChoiceType::class, [
                'required' => true,
                'label' => 'phpmob.form.transaction.account',
            ])
            ->add('slip', SlipType::class, [
                'required' => true,
                'label' => 'phpmob.form.transaction.slip',
            ])
        ;
    }
}
