<?php

namespace App\Controller;

use App\Form\UtilisateurEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{

    /**
     * @Route("/account", name="account", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UtilisateurEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('user/account.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

}