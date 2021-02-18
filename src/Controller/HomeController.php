<?php

namespace App\Controller;

use App\Entity\Choix;
use App\Form\ChoixType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/admin", name="admin_home")
     */
    public function adminhome(): Response
    {
        return $this->render('admin/index.html.twig')
        ;
    }

     /**
     * @Route("/new", name="choix_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $choix = new Choix();
        $form = $this->createForm(ChoixType::class, $choix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($choix);
            $entityManager->flush();

            $this->addFlash('success',"Votre formulaire a bien été envoyé.");

            return $this->redirectToRoute('choix_new');
        }

        return $this->render('choix/new.html.twig', [
            'choix' => $choix,
            'form' => $form->createView(),
        ]);
    }
}
