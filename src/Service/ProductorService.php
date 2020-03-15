<?php

namespace App\Service;

use App\Repository\ProductorRepository;

class ProductorService
{

    private $productorRepository;

    public function __construct(ProductorRepository $productorRepository)
    {
        $this->productorRepository = $productorRepository;
    }

    public function getAllProductorByPosition()
    {
        $productor = $this->productorRepository->findAll([], ['position' => 'ASC']);

        return $productor;
    }
}