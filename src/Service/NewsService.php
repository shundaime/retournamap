<?php

namespace App\Service;

use App\Repository\NewsRepository;

class NewsService
{

    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getAllNews() : array
    {
        $news = $this->newsRepository->findAll();

        return $news;
    }
}