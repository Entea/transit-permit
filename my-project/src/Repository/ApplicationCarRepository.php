<?php

namespace App\Repository;

use App\Entity\ApplicationCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ApplicationCar|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationCar|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationCar[]    findAll()
 * @method ApplicationCar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationCarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationCar::class);
    }

    // /**
    //  * @return ApplicationCar[] Returns an array of ApplicationCar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ApplicationCar
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
