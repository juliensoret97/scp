<?php

namespace App\Controller;

use App\Entity\Soutien;
use App\Form\SoutienType;
use App\Repository\SoutienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/soutien")
 */
class SoutienController extends AbstractController
{
    /**
     * @Route("/", name="soutien_index", methods={"GET"})
     */
    public function index(SoutienRepository $soutienRepository): Response
    {
        return $this->render('soutien/index.html.twig');
    }

    /**
     * @Route("/new", name="soutien_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $soutien = new Soutien();
        $form = $this->createForm(SoutienType::class, $soutien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($soutien);
            $entityManager->flush();

            return $this->redirectToRoute('soutien_index');
        }

        return $this->render('soutien/new.html.twig', [
            'soutien' => $soutien,
            'form' => $form->createView(),
        ]);
    }
}
