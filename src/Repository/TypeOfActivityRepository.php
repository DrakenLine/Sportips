<?php

namespace App\Repository;

use App\Entity\TypeOfActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeOfActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOfActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOfActivity[]    findAll()
 * @method TypeOfActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOfActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeOfActivity::class);
    }

    // /**
    //  * @return TypeOfActivity[] Returns an array of TypeOfActivity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeOfActivity
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
