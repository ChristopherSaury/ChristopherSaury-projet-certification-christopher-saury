<?php

namespace App\Repository;

use App\Entity\Dishes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dishes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dishes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dishes[]    findAll()
 * @method Dishes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DishesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dishes::class);
    }

    public function getPaginatedDishes($page, $limit, $filter = null){
        $query = $this->createQueryBuilder('d')
        ->where('d.active = 1')
        ->orderBy('d.id')
        ->setFirstResult(($page * $limit) - $limit)
        ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }

    public function getTotalDishes(){
        $query = $this->createQueryBuilder('d')
            ->select('COUNT(d)')
            ->where('d.active = 1');

            return $query->getQuery()->getSingleScalarResult();  
    }

    // /**
    //  * @return Dishes[] Returns an array of Dishes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dishes
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
