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
        $contract->setName("Fromage de brebis et pain")
                    ->setPdf('fromage.pdf');

        $productor = new Productor();
        $productor->setName("La ferme des Fromentaux")
            ->setPicture("fromentaux.jpg")
            ->setDelivery('Hebdomadaire')
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



    /*public function createProductor():Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $productor = new Productor();
        $productor->setName("Brasserie de l'emblavez")
            ->setPicture("emblavez.jpg")
            ->setProducts("Bières blondes, ambrées, blanches, IPA")
            ->setDelivery("Bi-ensuelle")
            ->setLabel("nature.jpg");
        $entityManager->persist($productor);
        $entityManager->flush();

        return new Response("Nouveau producteur enregistré avec l'id ". $productor->getId());
    }*/

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