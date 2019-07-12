<?php


namespace App\Controller;

use App\Entity\Contract;
use App\Entity\Productor;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductorController extends PagesController
{
    /**
     * @Route("/producteurs_creation", name="productors_create")
     */

    public function index(): Response
    {


        $contract = new Contract();
        $contract->setName("Fraises et framboises")
                    ->setPdf('');

        $productor = new Productor();
        $productor->setName("Marie-François Bourgeat")
            ->setFilename("bourgeat.jpg")
            ->setDelivery("Hebdomadaire en été")
            ->setLabel('ecocert.jpg')
            ->setImageDescription("Fruits rouges");

        $productor->addContract($contract);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contract);
        $entityManager->persist($productor);
        $entityManager->flush();

        return new Response(
          "Producteur enregistré avec l'id: ".$productor->getId()
            ." et contrat avec l'id: ".$contract->getId()
        );
    }

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