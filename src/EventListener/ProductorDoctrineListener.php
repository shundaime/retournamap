<?php


namespace App\EventListener;


use App\Entity\Productor;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ProductorDoctrineListener
{
    private $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Productor) {
            $this->fileUploader->remove($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Productor) {
            if($entity->getImageFile()){
                $this->fileUploader->remove($entity);
                $filename = $this->fileUploader->upload($entity->getImageFile());
                $entity->setFilename($filename);
            }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Productor) {
            $filename = $this->fileUploader->upload($entity->getImageFile());
            $entity->setFilename($filename);
        }
    }

}