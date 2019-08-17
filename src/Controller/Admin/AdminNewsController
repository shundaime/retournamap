<?php


namespace App\Controller\Admin;


use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminNewsController extends AbstractController
{
    /**
     * @var NewsRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(NewsRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/news", name="admin.news.index")
     * @return Response
     */
    public function index()
    {
        $news = $this->repository->findAll();
        return $this->render('admin/news/index.html.twig',
            ['news' => $news]);
    }

    /**
     * @Route("/admin/news/new", name="admin.news.new")
     */
    public function new(Request $request)
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news, ['validation_groups' => ['Default', 'new']]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($news);
            $this->em->flush();
            $this->addFlash('success', "Actualité créée avec succès");
            return $this->redirectToRoute('admin.news.index');
        }
        return $this->render('admin/news/new.html.twig',
            ['new' => $news,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/news/{id}", name="admin.news.edit", methods="GET|POST")
     * @param News $news
     * @param Request $request
     * @return Response
     */
    public function edit(News $news, Request $request)
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($news);
            $this->em->flush();
            $this->addFlash('success', "Actualité modifiée avec succès");
            return $this->redirectToRoute('admin.news.index');
        }

        return $this->render('admin/news/edit.html.twig',
            ['new' => $news,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/news/{id}", name="admin.news.delete", methods="DELETE")
     * @param News $news
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(News $news, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $news->getId(), $request->get('_token'))){
            $this->em->remove($news);
            $this->em->flush();
            $this->addFlash('success', "Actualité supprimée avec succès");
        }
        return $this->redirectToRoute('admin.news.index');
    }
}