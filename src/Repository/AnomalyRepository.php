<?php

namespace App\Repository;

use App\Entity\Anomaly;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Anomaly|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anomaly|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anomaly[]    findAll()
 * @method Anomaly[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnomalyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anomaly::class);
    }

    // /**
    //  * @return Anomaly[] Returns an array of Anomaly objects
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
    public function findOneBySomeField($value): ?Anomaly
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
