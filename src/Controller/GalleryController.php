<?php


namespace App\Controller;


use App\Entity\GalleryImage;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends PagesController
{
    /**
     * @Route("/galerie", name="show_gallery")
     */
    public function showGallery()
    {
        $repository = $this->getDoctrine()->getRepository(GalleryImage::class);
        $images = $repository->findAll();
        return $this->render('pages/gallery.html.twig',['images' => $images]);
    }
}