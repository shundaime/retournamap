<?php


namespace App\EventListener;


use App\Entity\GalleryImage;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;

class GalleryDoctrineListener
{
    private $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof GalleryImage) {
            $this->fileUploader->remove($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof GalleryImage) {
            if($entity->getImageFile()){
                $this->fileUploader->remove($entity);
                $filename = $this->fileUploader->upload($entity);
                $entity->setImageFileName($filename);
            }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof GalleryImage) {
            $filename = $this->fileUploader->upload($entity);
            $entity->setImageFileName($filename);
        }
    }
}