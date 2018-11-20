<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AccountTranslationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'phpmob.form.account.name',
            ])
            ->add('branch', TextType::class, [
                'required' => true,
                'label' => 'phpmob.form.account.branch',
            ])
            ->add('address', TextareaType::class, [
                'required' => false,
                'label' => 'phpmob.form.account.address',
            ])
            ->add('note', TextareaType::class, [
                'required' => false,
                'label' => 'phpmob.form.account.note',
            ])
        ;
    }
}
