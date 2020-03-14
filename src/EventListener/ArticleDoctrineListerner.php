<?php


namespace App\EventListener;


use App\Entity\Articles;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ArticleDoctrineListerner
{
    private $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Articles) {
            $this->fileUploader->remove($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Articles) {
            if($entity->getImageFile()){
                $this->fileUploader->remove($entity);
                $filename = $this->fileUploader->upload($entity);
                $entity->setFilename($filename);
            }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Articles) {
            $filename = $this->fileUploader->upload($entity);
            $entity->setFilename($filename);
        }
    }

}