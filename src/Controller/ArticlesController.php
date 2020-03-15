<?php


namespace App\Controller;


use App\Entity\Articles;
use App\Service\ArticlesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{

    /**
     * @Route("/articles", name="show_articles", methods={"GET"})
     */
    public function showArticles(ArticlesService $articlesService) : Response
    {
        
        $articles = $articlesService->getAllArticle();

        return $this->render('pages/articles.html.twig',['articles' => $articles]);
    }
}