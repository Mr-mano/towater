<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduitCategorieController extends AbstractController
{
    /**
     * @Route("/produit/categorie", name="produit_categorie")
     */
    public function index()
    {
        return $this->render('produit_categorie/index.html.twig', [
            'controller_name' => 'ProduitCategorieController',
        ]);
    }
}
