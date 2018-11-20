<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AccountType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', TextType::class, [
                'required' => true,
                'label' => 'phpmob.form.account.number',
            ])
            ->add('bank', BankChoiceType::class, [
                'required' => true,
                'label' => 'phpmob.form.account.bank',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => AccountTranslationType::class,
                'label' => 'phpmob.form.account.translations',
            ])
        ;
    }
}
