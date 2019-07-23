<?php


namespace App\Controller;


use App\Entity\News;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends PagesController
{
    /**
     * @Route("/", name="news")
     */
    public function list()
    {
        $repository = $this->getDoctrine()->getRepository(News::class);
        $news = $repository->findAll();
        return $this->render('pages/home.html.twig',
            ['news' => $news]);
    }
}