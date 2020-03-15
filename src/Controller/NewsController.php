<?php


namespace App\Controller;


use App\Entity\News;
use App\Service\NewsService;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends PagesController
{
    /**
     * @Route("/", name="news", methods={"GET"})
     */
    public function list(NewsService $newsService)
    {

        $news = $newsService->getAllNews();

        if (empty($news))
        {
            return $this->render('pages/home.html.twig');
        }
        else
        {
            return $this->render('pages/home.html.twig',
                ['news' => $news]);
        }
    }
}