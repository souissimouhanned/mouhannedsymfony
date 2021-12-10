<?php

namespace App\Repository;

use App\Entity\Detailaccident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detailaccident|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailaccident|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailaccident[]    findAll()
 * @method Detailaccident[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailaccidentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detailaccident::class);
    }

    // /**
    //  * @return Detailaccident[] Returns an array of Detailaccident objects
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
    public function findOneBySomeField($value): ?Detailaccident
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
