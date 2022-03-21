<?php

namespace App\Controller;

use App\Entity\Praticiens;
use App\Form\PraticiensType;
use App\Repository\PraticiensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/praticiens")
 */
class PraticiensController extends AbstractController
{
    /**
     * @Route("/", name="praticiens_index", methods={"GET"})
     */
    public function index(PraticiensRepository $praticiensRepository): Response
    {
        return $this->render('praticiens/index.html.twig', [
            'praticiens' => $praticiensRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="praticiens_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $praticien = new Praticiens();
        $form = $this->createForm(PraticiensType::class, $praticien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($praticien);
            $entityManager->flush();

            return $this->redirectToRoute('praticiens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('praticiens/new.html.twig', [
            'praticien' => $praticien,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="praticiens_show", methods={"GET"})
     */
    public function show(Praticiens $praticien): Response
    {
        return $this->render('praticiens/show.html.twig', [
            'praticien' => $praticien,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="praticiens_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Praticiens $praticien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PraticiensType::class, $praticien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('praticiens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('praticiens/edit.html.twig', [
            'praticien' => $praticien,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="praticiens_delete", methods={"POST"})
     */
    public function delete(Request $request, Praticiens $praticien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$praticien->getId(), $request->request->get('_token'))) {
            $entityManager->remove($praticien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('praticiens_index', [], Response::HTTP_SEE_OTHER);
    }
}
