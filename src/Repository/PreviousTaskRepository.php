<?php

namespace App\Repository;

use App\Entity\PreviousTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PreviousTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreviousTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreviousTask[]    findAll()
 * @method PreviousTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreviousTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreviousTask::class);
    }

    // /**
    //  * @return PreviousTask[] Returns an array of PreviousTask objects
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
    public function findOneBySomeField($value): ?PreviousTask
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
