<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\FormBuilderInterface;

class BankType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => BankTranslationType::class,
                'label' => 'phpmob.form.bank.translations',
            ])
            ->add('logo', BankLogoType::class, [
                'required' => false,
                'label' => 'phpmob.form.bank.logo',
            ])
        ;
    }
}
