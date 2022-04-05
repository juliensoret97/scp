<?php

namespace App\Repository;

use App\Entity\FormationScp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormationScp|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormationScp|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormationScp[]    findAll()
 * @method FormationScp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationScpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormationScp::class);
    }

    // /**
    //  * @return FormationScp[] Returns an array of FormationScp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormationScp
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
