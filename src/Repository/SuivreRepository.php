<?php

namespace App\Repository;

use App\Entity\Suivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Suivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Suivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Suivre[]    findAll()
 * @method Suivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuivreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Suivre::class);
    }

    // /**
    //  * @return Suivre[] Returns an array of Suivre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Suivre
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
