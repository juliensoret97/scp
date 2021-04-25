<?php

namespace App\Controller;

use App\Entity\Soutien;
use App\Entity\Formation;
use App\Repository\SoutienRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/formation/inscris", name="formation_inscris", methods={"GET","POST"})
     */
    public function formationshow(FormationRepository $formationRepository): Response
    {
        return $this->render('formation/formation.html.twig', [
            'formations' => $formationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/formation/{id}/edit", name="formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formation $formation): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formation');
        }

        return $this->render('formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/formation/{id}", name="formation_show", methods={"GET"})
     */
    public function showFormation(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    /**
     * @Route("/formation/{id}", name="formation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Formation $formation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formation');
    }

    /**
     * @Route("/soutien/inscris", name="soutien_inscris", methods={"GET","POST"})
     */
    public function soutienshow(SoutienRepository $soutienRepository): Response
    {
        return $this->render('soutien/soutien.html.twig', [
            'soutiens' => $soutienRepository->findAll(),
        ]);
    }

    /**
     * @Route("/soutien/{id}", name="soutien_show", methods={"GET"})
     */
    public function show(Soutien $soutien): Response
    {
        return $this->render('soutien/show.html.twig', [
            'soutien' => $soutien,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="soutien_edit", methods={"GET","POST"})
     */
    public function editSoutien(Request $request, Soutien $soutien): Response
    {
        $form = $this->createForm(SoutienType::class, $soutien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('soutien_index');
        }

        return $this->render('soutien/edit.html.twig', [
            'soutien' => $soutien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/soutien/{id}", name="soutien_delete", methods={"DELETE"})
     */
    public function deleteSoutien(Request $request, Soutien $soutien): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soutien->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soutien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('soutien_index');
    }
}
