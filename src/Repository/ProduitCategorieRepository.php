<?php

namespace App\Repository;

use App\Entity\ProduitCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProduitCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitCategorie[]    findAll()
 * @method ProduitCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitCategorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProduitCategorie::class);
    }

    /**
     * @return mixed
     */
    public function findAllWithProduitCategorie()
    {
        $qb = $this->createQueryBuilder('pc');

        $qb->select('pc')
            ->leftJoin('pc.produits', 'p')
            ->groupBy('pc.id');

        return $qb->getQuery()->getResult();
    }
    // /**
    //  * @return ProduitCategorie[] Returns an array of ProduitCategorie objects
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
    public function findOneBySomeField($value): ?ProduitCategorie
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
