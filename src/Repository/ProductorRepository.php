<?php

namespace App\Repository;

use App\Entity\Productor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Productor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productor[]    findAll()
 * @method Productor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productor::class);
    }


    /*
    public function findOneBySomeField($value): ?Productor
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
