<?php


namespace App\Controller;


use App\Entity\Articles;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends PagesController
{
    /**
     * @Route("/articles", name="show_articles")
     */
    public function showArticles()
    {
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repository->findAll();
        return $this->render('pages/articles.html.twig',['articles' => $articles]);
    }
}