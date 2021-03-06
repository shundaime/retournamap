<?php

namespace App\Service;

use App\Repository\ArticlesRepository;

class ArticlesService
{

    private $articlesRepository;

    public function __construct(ArticlesRepository $articlesRepository)
    {
        $this->articlesRepository = $articlesRepository;
    }

    public function getAllArticle() : array
    {
        $articles = $this->articlesRepository->findBy(array(), array('position' => 'ASC'));
        return $articles;
    }

}