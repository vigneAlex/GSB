<?php

namespace App\Controller;

use App\Entity\Visites;
use App\Form\VisitesType;
use App\Repository\VisitesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visites")
 */
class VisitesController extends AbstractController
{
    /**
     * @Route("/", name="visites_index", methods={"GET"})
     */
    public function index(VisitesRepository $visitesRepository): Response
    {
        return $this->render('visites/index.html.twig', [
            'visites' => $visitesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="visites_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $visite = new Visites();
        $form = $this->createForm(VisitesType::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($visite);
            $entityManager->flush();

            return $this->redirectToRoute('visites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visites/new.html.twig', [
            'visite' => $visite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="visites_show", methods={"GET"})
     */
    public function show(Visites $visite): Response
    {
        return $this->render('visites/show.html.twig', [
            'visite' => $visite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="visites_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Visites $visite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VisitesType::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('visites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visites/edit.html.twig', [
            'visite' => $visite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="visites_delete", methods={"POST"})
     */
    public function delete(Request $request, Visites $visite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($visite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visites_index', [], Response::HTTP_SEE_OTHER);
    }
}
