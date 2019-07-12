<?php


namespace App\Controller;

use App\Entity\Productor;
use Symfony\Component\Routing\Annotation\Route;


class ProductorController extends PagesController
{
    /**
     * @Route("/producteurs", name="show_productors")
     */
    public function list()
    {
        $repository = $this->getDoctrine()->getRepository(Productor::class);
        $productors = $repository->findAll();
        return $this->render('pages/productors.html.twig', ['productors' => $productors]);
    }
}