<?php

namespace App\Service;

use App\Repository\GalleryImageRepository;

class GalleryService
{

    private $galleryImageRepository;

    public function __construct(GalleryImageRepository $galleryImageRepository)
    {
        $this->galleryImageRepository = $galleryImageRepository;
    }

    public function getAllImage() : array
    {
        $image = $this->galleryImageRepository->findAll();
        return $image;
    }
}