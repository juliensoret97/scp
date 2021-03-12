<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoutienController extends AbstractController
{
    /**
     * @Route("/soutien", name="soutien")
     */
    public function index(): Response
    {
        return $this->render('soutien/index.html.twig', [
            'controller_name' => 'SoutienController',
        ]);
    }
}
