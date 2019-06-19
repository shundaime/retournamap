<?php

namespace App\Repository;

use App\Entity\Productors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Productors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productors[]    findAll()
 * @method Productors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductorsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Productors::class);
    }

    // /**
    //  * @return Productors[] Returns an array of Productors objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Productors
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
