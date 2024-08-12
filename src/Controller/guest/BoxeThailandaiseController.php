<?php

declare(strict_types=1);

namespace App\Controller\guest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BoxeurRepository;
use Symfony\Component\Routing\Annotation\Route;

class BoxeThailandaiseController extends AbstractController
{

    #[Route('/boxe-thailandaise', 'home_boxe_thailandaise')]
    public function boxeThailandaise(): Response
    {
        return $this->render('guest/thailandaise/thailandaise.html.twig');
    }


    #[Route('/boxe-thailandaise/superplumes', 'boxe_thailandaise_superplumes')]
    public function boxeThailandaise57(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/thailandaise/thailandaiseSuperPlumes.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }


    #[Route('/boxe-thailandaise/superlourds', 'boxe_thailandaise_superlourds')]
    public function boxeThailandaise100(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/thailandaise/thailandaiseSuperLourds.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }






}