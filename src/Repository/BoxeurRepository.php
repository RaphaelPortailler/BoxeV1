<?php

namespace App\Repository;

use App\Entity\Boxeur;
use App\Entity\TypeBoxe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Boxeur>
 */
class BoxeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Boxeur::class);
    }

    //    /**
    //     * @return Boxeur[] Returns an array of Boxeur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Boxeur
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByTypeBoxe(TypeBoxe $typeBoxe)
    {
        return $this->createQueryBuilder('b')
            ->join('b.pratiques', 'p')
            ->andWhere('p.Type_boxe = :typeBoxe')
            ->setParameter('typeBoxe', $typeBoxe)
            ->getQuery()
            ->getResult();
    }
}
