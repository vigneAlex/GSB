<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatioController extends AbstractController
{
    /**
     * @Route("/ratio", name="ratio")
     */
    public function index(): Response
    {
        $visiteurs = $VisiteursRepository->findAll();
        $praticiens = $PraticiensRepository->findAll();
        return $this->render('ratio/index.html.twig', [
            'ratioPraticiensVisiteurs' => $praticiens/$visiteurs,
        ]);
    }
}
