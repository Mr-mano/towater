<?php
// src/Controller/HomepageController.php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\HttpFoundation\Request;
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


    public function homepage(PaginatorInterface $paginator, Request $request, ArticleRepository $articleRepository, CommentaireRepository $commentaireRepository, EvenementRepository $EvenementRepository ): Response
    {
        $em = $this->getDoctrine();
        $articleRepository = $paginator->paginate(
            $em->getRepository(Article::class)->findBy([], ["date_creation" => "DESC"]),
            $request->query->getInt('page', 1), 7
        );

        return $this->render('default/homepage.html.twig', [
            'articles' => $articleRepository,
            'commentaires' =>$commentaireRepository->findBy(["utilisateur" => $this->getUser()], ["date_creation" => "DESC"]),
            'evenements' => $EvenementRepository->findBy([], ["date_evenement" => "DESC"]),
        ]);
    }

    /**
     * @Route("show/{id}", name="default_show", methods={"GET"})
     *
     */
    public function show(Article $article): Response
    {
        return $this->render('default/show.html.twig', [
            'article' => $article,
        ]);
    }

}





