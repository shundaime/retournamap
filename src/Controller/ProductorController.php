<?php


namespace App\Controller;

use App\Entity\Productor;
use App\Service\ProductorService;
use Symfony\Component\Routing\Annotation\Route;


class ProductorController extends PagesController
{
    /**
     * @Route("/producteurs", name="show_productors", methods={"GET"})
     */
    public function list(ProductorService $productorService)
    {
        $productors = $productorService->getAllProductorByPosition();
        
        return $this->render('pages/productors.html.twig', ['productors' => $productors]);
    }
}