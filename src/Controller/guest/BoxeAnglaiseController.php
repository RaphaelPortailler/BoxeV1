<?php

declare(strict_types=1);

namespace App\Controller\guest;

use App\Repository\PratiqueRepository;
use App\Repository\TypeBoxeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\BoxeurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoxeAnglaiseController extends AbstractController
{

    #[Route('/boxe-anglaise', 'home_boxe_anglaise')]
    public function boxeAnglaise(BoxeurRepository $boxeurRepository, TypeBoxeRepository $typeBoxeRepository)
    {
        $typeBoxe = $typeBoxeRepository->findOneById(1);

        if ($typeBoxe) {
            $boxeurs = $boxeurRepository->findByTypeBoxe($typeBoxe);

            return $this->render('guest/anglaise/anglaise.html.twig', [
                'boxeurs' => $boxeurs,
                'typeBoxe' => $typeBoxe
            ]);
        }
        return $this->render('guest/404.html.twig');
    }





    #[Route('/boxe-anglaise/superplumes', 'boxe_anglaise_superplumes')]
    public function boxeAnglaise57(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/anglaise/anglaiseSuperPlumes.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }



    #[Route('/boxe-anglaise/superlourd', 'boxe_anglaise_superlourd')]
    public function boxeAnglaise64(BoxeurRepository $boxeurRepository): Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/anglaise/anglaiseSuperLourds.html.twig', [
            'boxeurs' => $boxeur
        ]);

    }




}

