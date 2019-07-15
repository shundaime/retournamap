<?php


namespace App\Service;


use App\Entity\Contract;
use App\Entity\GalleryImage;
use App\Entity\Productor;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $productorDirectory;
    private $contractDirectory;
    private $galleryDirectory;

    public function __construct($productorDirectory, $contractDirectory, $galleryDirectory)
    {
        $this->productorDirectory = $productorDirectory;
        $this->contractDirectory = $contractDirectory;
        $this->galleryDirectory = $galleryDirectory;
    }

    public function upload($entity)
    {
        if($entity instanceof Productor){
            return $this->uploadFile($entity->getImageFile(), $this->productorDirectory);
        }

        if($entity instanceof Contract){
            return $this->uploadFile($entity->getPdfFile(), $this->contractDirectory);
        }

        if($entity instanceof GalleryImage){
            return $this->uploadFile($entity->getImageFile(), $this->galleryDirectory);
        }
        return null;
    }

    public function remove($entity)
    {
        if($entity instanceof Productor){
            try {
                unlink($this->productorDirectory.'/'.$entity->getFilename());
            }catch (\Exception $exception){

            }
        }
        if($entity instanceof Contract){
            try {
                unlink($this->contractDirectory.'/'.$entity->getFilename());
            }catch (\Exception $exception){

            }
        }

        if($entity instanceof GalleryImage){
            try {
                unlink($this->galleryDirectory.'/'.$entity->getImageFileName());
            }catch (\Exception $exception){

            }
        }
    }

    private function uploadFile(UploadedFile $file, $directory){
        $fileName = null;
        if($file){
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

            try {
                $file->move($directory, $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
        }
        return $fileName;
    }
}