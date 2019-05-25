<?php

namespace App\Controller;


use App\Entity\Produit;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pageproduit")
 */
class PageproduitController extends AbstractController
{

    /**
     * @Route("/pageproduit", name="pageproduit", methods={"GET","POST"})
     */
    public function pageproduit()
    {
        $em = $this->getDoctrine();
        $utilisateur = $em->getRepository(Utilisateur::class)->findAll();
        $produits = $em->getRepository(Produit::class)->findAll();


        return $this->render('pageproduit/index.html.twig', [
            'utilisateur' => $utilisateur,
            'produits' => $produits,

        ]);
    }

    /**
     * @Route("/{id}", name="pageproduit_show", methods={"GET"})
     *
     */
    public function show(Produit $produit): Response
    {
        return $this->render('pageproduit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

}
