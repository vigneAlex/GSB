<?php

namespace App\Controller;

use App\Entity\Motifs;
use App\Form\MotifsType;
use App\Repository\MotifsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/motifs")
 */
class MotifsController extends AbstractController
{
    /**
     * @Route("/", name="motifs_index", methods={"GET"})
     */
    public function index(MotifsRepository $motifsRepository): Response
    {
        return $this->render('motifs/index.html.twig', [
            'motifs' => $motifsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="motifs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $motif = new Motifs();
        $form = $this->createForm(MotifsType::class, $motif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($motif);
            $entityManager->flush();

            return $this->redirectToRoute('motifs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('motifs/new.html.twig', [
            'motif' => $motif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="motifs_show", methods={"GET"})
     */
    public function show(Motifs $motif): Response
    {
        return $this->render('motifs/show.html.twig', [
            'motif' => $motif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="motifs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Motifs $motif, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MotifsType::class, $motif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('motifs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('motifs/edit.html.twig', [
            'motif' => $motif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="motifs_delete", methods={"POST"})
     */
    public function delete(Request $request, Motifs $motif, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motif->getId(), $request->request->get('_token'))) {
            $entityManager->remove($motif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('motifs_index', [], Response::HTTP_SEE_OTHER);
    }
}
