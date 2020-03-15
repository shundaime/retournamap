<?php


namespace App\Controller;


use App\Entity\GalleryImage;
use App\Service\GalleryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController
{
    /**
     * @Route("/galerie", name="show_gallery", methods={"GET"})
     */
    public function showGallery(GalleryService $galleryService)
    {
        $images = $galleryService->getAllImage();

        return $this->render('pages/gallery.html.twig',['images' => $images]);
    }
}