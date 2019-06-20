<?php


namespace App\Controller;

use App\Entity\Productor;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductorController extends PagesController
{
    /**
     * @Route("/producteurs_creation", name="productors_create")
     */
    public function createProductor():Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $productor = new Productor();
        $productor->setName("...")
            ->setPicture("...")
            ->setProducts("...")
            ->setDelivery("...")
            ->setLabel("...");
        $entityManager->persist($productor);
        $entityManager->flush();

        return new Response("Nouveau producteur enregistré avec l'id". $productor->getId());
    }

    /**
     * @Route("/producteurs", name="show_productors")
     */
    public function show()
    {
        $repository = $this->getDoctrine()->getRepository(Productor::class);
        $productor = $repository->findAll();
        return $this->render('pages/productors.html.twig', compact('productor'));
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