<?php

namespace App\Repository;

use App\Entity\Activity;
use App\Entity\TypeOfActivity;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function getLatestPaginatedActivities(PaginatorInterface $paginator, $page = 1)
    {
        $query = $this->findAll();


        return $paginator->paginate($query, $page, 9);
    }

    public function getLastActivity(User $user){
        return $this->createQueryBuilder('a')
            ->leftJoin('a.user', 'u')
            ->andWhere('a.user = :user')
            ->setParameter('user', $user)
            ->orderBy('a.didAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getActivities(User $user){
        return $this->createQueryBuilder('a')
            ->leftJoin('a.user', 'u')
            ->andWhere('a.user = :user')
            ->setParameter('user', $user)
            ->orderBy('a.didAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getTypeOfActivity(Activity $activity){
        return $this->createQueryBuilder('a')
            ->leftJoin('a.typeOf', 'a')
            ->andWhere('a.name = :type')
            ->setParameter('type', $activity)
            ->getQuery()
            ->getResult();
    }



    // /**
    //  * @return Activity[] Returns an array of Activity objects
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
    public function findOneBySomeField($value): ?Activity
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
