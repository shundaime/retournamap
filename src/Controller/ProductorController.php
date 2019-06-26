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
        $contract->setName("Confitures, sirops")
                    ->setPdf('confitures.pdf');

        $productor = new Productor();
        $productor->setName("Gourmandises Buissonnières")
            ->setPicture("gourmandises.jpg")
            ->setDelivery('Bi-mensuelle')
            ->setLabel('bio.png');

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

    /**
     * @Route("/admin/edit")
     */
    public function update($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $productor = $entityManager->getRepository(Productor::class)->find($id);

        if(!$productor){
            throw $this->createNotFoundException(
              "Aucun producteur avec l'id ".$id
            );
        }

        $productor->setName('');
        $entityManager->flush();

        return $this->redirectToRoute('show_productors', [
           'id' => $productor->getId()
        ]);
    }

    public function delete()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $productor = $entityManager->getRepository(Productor::class)->findAll();
        $entityManager->remove($productor);
        $entityManager->flush();
    }
}