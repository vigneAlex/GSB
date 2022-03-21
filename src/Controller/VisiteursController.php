<?php

namespace App\Controller;

use App\Entity\Visiteurs;
use App\Form\VisiteursType;
use App\Repository\VisiteursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visiteurs")
 */
class VisiteursController extends AbstractController
{
    /**
     * @Route("/", name="visiteurs_index", methods={"GET"})
     */
    public function index(VisiteursRepository $visiteursRepository): Response
    {
        return $this->render('visiteurs/index.html.twig', [
            'visiteurs' => $visiteursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="visiteurs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $visiteur = new Visiteurs();
        $form = $this->createForm(VisiteursType::class, $visiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($visiteur);
            $entityManager->flush();

            return $this->redirectToRoute('visiteurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visiteurs/new.html.twig', [
            'visiteur' => $visiteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="visiteurs_show", methods={"GET"})
     */
    public function show(Visiteurs $visiteur): Response
    {
        return $this->render('visiteurs/show.html.twig', [
            'visiteur' => $visiteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="visiteurs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Visiteurs $visiteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VisiteursType::class, $visiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('visiteurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visiteurs/edit.html.twig', [
            'visiteur' => $visiteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="visiteurs_delete", methods={"POST"})
     */
    public function delete(Request $request, Visiteurs $visiteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visiteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($visiteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visiteurs_index', [], Response::HTTP_SEE_OTHER);
    }
}
