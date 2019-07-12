<?php


namespace App\EventListener;

use App\Entity\Contract;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;


class ContractDoctrineListener
{
    private $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Contract) {
            $this->fileUploader->remove($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Contract) {
            if($entity->getPdfFile()){
                $this->fileUploader->remove($entity);
                $filename = $this->fileUploader->upload($entity);
                $entity->setFileName($filename);
            }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Contract) {
            $filename = $this->fileUploader->upload($entity);
            $entity->setFilename($filename);
        }
    }
}