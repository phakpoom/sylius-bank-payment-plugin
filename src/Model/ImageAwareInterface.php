<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\Model;

use Sylius\Component\Core\Model\ImageInterface;

interface ImageAwareInterface
{
    /**
     * @return null|ImageInterface
     */
    public function getImage(): ?ImageInterface;

    /**
     * @param null|ImageInterface $image
     */
    public function setImage(?ImageInterface $image): void;
}
