<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function findProduitByUtilisateur(Utilisateur $utilisateur,int $limit, Produit $produit = null): array
    {
        $qb = $this->createQueryBuilder('p');
        $qb = $qb->innerJoin('p.Utilisateur', 'u')
            ->where($qb->expr()->eq('u.id', ':utilisateur'));

        if ($produit != null) {
            $qb = $qb->andWhere($qb->expr()->neq('p.id', ':produit'))
                ->setParameter(':produit', $produit->getId());
        }

        return $qb->setParameter(':utilisateur', $utilisateur->getId())
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findLast (int $limit = 10) : array
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $qb->select('p', 'u')
            ->innerJoin('p.Utilisateur', 'u')
            ->orderBy('p.date_creation', 'DESC')
            ->setMaxResults($limit);

        return $qb->getQuery()
            ->getResult();
    }






}
