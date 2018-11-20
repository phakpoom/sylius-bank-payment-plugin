<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class AdminMenuBuilder
{
    public function buildMenu(MenuBuilderEvent $menuBuilderEvent): void
    {
        $menu = $menuBuilderEvent->getMenu();
        $cmsRootMenuItem = $menu
            ->addChild('phpmob_bank_payment')
            ->setLabel('phpmob.menu.bank_payment')
        ;

        $cmsRootMenuItem
            ->addChild('banks', [
                'route' => 'phpmob_admin_bank_index',
            ])
            ->setLabel('phpmob.menu.bank_payment_banks')
            ->setLabelAttribute('icon', 'file')
        ;

        $cmsRootMenuItem
            ->addChild('accounts', [
                'route' => 'phpmob_admin_account_index',
            ])
            ->setLabel('phpmob.menu.bank_payment_accounts')
            ->setLabelAttribute('icon', 'file')
        ;

        $cmsRootMenuItem
            ->addChild('transactions', [
                'route' => 'phpmob_admin_transaction_index',
            ])
            ->setLabel('phpmob.menu.bank_payment_transactions')
            ->setLabelAttribute('icon', 'file')
        ;
    }
}
