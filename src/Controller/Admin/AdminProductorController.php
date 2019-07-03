<?php


namespace App\Controller\Admin;


use App\Entity\Productor;
use App\Form\ProductorType;
use App\Repository\ProductorRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductorController extends AbstractController
{
    /**
     * @var ProductorRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ProductorRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $productors = $this->repository->findAll();
        return $this->render('admin/productor/index.html.twig', ['productors' => $productors]);
    }

    /**
     * @Route("/admin/productor/create", name="admin.new")
     */
    public function new(Request $request)
    {
        $productor = new Productor();
        $form = $this->createForm(ProductorType::class,$productor);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($productor);
            $this->em->flush();
            return $this->redirectToRoute('admin.index');
        }
        return $this->render('admin/productor/new.html.twig',
            ['productor' => $productor,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/productor/{id}", name="admin.edit", methods="GET|POST")
     * @param Productor $productor
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Productor $productor, Request $request)
    {
        $form = $this->createForm(ProductorType::class, $productor);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.index');
        }

        return $this->render('admin/productor/edit.html.twig',
            ['productor' => $productor,
            'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/productor/{id}", name="admin.delete", methods="DELETE")
     * @param Productor $productor
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Productor $productor, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $productor->getId(), $request->get('_token'))){
            $this->em->remove($productor);
            $this->em->flush();
        }
        return $this->redirectToRoute('admin.index');
    }
}