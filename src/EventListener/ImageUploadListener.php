<?php

declare(strict_types=1);

namespace PhpMob\SyliusBankPaymentPlugin\EventListener;

use PhpMob\SyliusBankPaymentPlugin\Model\ImageAwareInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class ImageUploadListener
{
    /**
     * @var ImageUploaderInterface
     */
    private $uploader;

    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadImage(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, ImageAwareInterface::class);

        $this->uploadSubjectImage($subject);
    }

    private function uploadSubjectImage(ImageAwareInterface $subject): void
    {
        $image = $subject->getImage();

        if ($image->hasFile()) {
            $this->uploader->upload($image);
        }

        // Upload failed? Let's remove that image.
        if (null === $image->getPath()) {
            $subject->setImage(null);
        }
    }
}
