<?php

declare(strict_types=1);

namespace App\Controller\guest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BoxeurRepository;
use Symfony\Component\Routing\Annotation\Route;

class BoxeAnglaiseController extends AbstractController
{

    #[Route('/boxe-anglaise', 'home_boxe_anglaise')]
    public function boxeAnglaise(BoxeurRepository $boxeurRepository):Response
    {
        return $this->render('guest/anglaise.html.twig');
    }





    #[Route('/boxe-anglaise/superplumes', 'boxe_anglaise_superplumes')]
    public function boxeAnglaise57(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/anglaiseSuperPlumes.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }




    #[Route('/boxe-anglaise/superlourd', 'boxe_anglaise_superlourd')]
    public function boxeAnglaise64(BoxeurRepository $boxeurRepository): Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/anglaise64.html.twig', [
            'boxeurs' => $boxeur
        ]);

    }




}

