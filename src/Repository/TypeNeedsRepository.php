<?php

namespace App\Repository;

use App\Entity\TypeNeeds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeNeeds|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeNeeds|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeNeeds[]    findAll()
 * @method TypeNeeds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeNeedsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeNeeds::class);
    }

    // /**
    //  * @return TypeNeeds[] Returns an array of TypeNeeds objects
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
    public function findOneBySomeField($value): ?TypeNeeds
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
