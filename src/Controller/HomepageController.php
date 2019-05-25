<?php
// src/Controller/HomepageController.php
namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Utilisateur;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use App\Repository\EvenementRepository;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class DefaultController
 * @package App\Controller
 */

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */


    public function homepage(ArticleRepository $articleRepository, CommentaireRepository $commentaireRepository, EvenementRepository $EvenementRepository ): Response
    {
        return $this->render('default/homepage.html.twig', [
            'articles' => $articleRepository->findBy([], ["date_creation" => "DESC"]),
            'commentaires' =>$commentaireRepository->findBy(["utilisateur" => $this->getUser()], ["date_creation" => "DESC"]),
            'evenements' => $EvenementRepository->findBy([], ["date_evenement" => "DESC"]),
        ]);
    }


}





