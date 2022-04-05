<?php

namespace App\Controller;

use App\Entity\FormationScp;
use App\Form\FormationScpType;
use App\Repository\FormationScpRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/formation/scp")
 */
class FormationScpController extends AbstractController
{
    /**
     * @Route("/", name="formation_scp_index", methods={"GET"})
     */
    public function index(FormationScpRepository $formationScpRepository): Response
    {
        return $this->render('formation_scp/index.html.twig', [
            'formation_scps' => $formationScpRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="formation_scp_show", methods={"GET"})
     */
    public function show(FormationScp $formationScp): Response
    {
        return $this->render('formation_scp/show.html.twig', [
            'formation_scp' => $formationScp,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formation_scp_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormationScp $formationScp): Response
    {
        $form = $this->createForm(FormationScpType::class, $formationScp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formation_scp_index');
        }

        return $this->render('formation_scp/edit.html.twig', [
            'formation_scp' => $formationScp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formation_scp_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FormationScp $formationScp): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formationScp->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formationScp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formation_scp_index');
    }
}
