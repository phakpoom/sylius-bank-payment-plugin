<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\StateCallback;

use PhpMob\SyliusBankPaymentPlugin\Model\TransactionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TransactionEndorse
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(TokenStorageInterface $tokenStorage, RequestStack $requestStack)
    {
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
    }

    /**
     * @param TransactionInterface $transaction
     */
    public function apply(TransactionInterface $transaction): void
    {
        $transaction->setEndorser($this->tokenStorage->getToken()->getUser());

        if (!$request = $this->requestStack->getCurrentRequest()) {
            return;
        }

        $transaction->setComment($request->get('comment'));
    }
}
