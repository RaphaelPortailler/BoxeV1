<?php

declare(strict_types=1);

namespace App\Controller\guest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BoxeurRepository;
use Symfony\Component\Routing\Annotation\Route;

class KickBoxingController extends AbstractController
{

    #[Route('/kickboxing', 'home_kickboxing')]
    public function kickboxing(): Response
    {
        return $this->render('guest/kickboxing/kickboxing.html.twig');
    }


    #[Route('/kickboxing/superplumes', 'kickboxing_superplumes')]
    public function kickboxing57(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/kickboxing/kickboxingSuperPlumes.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }


    #[Route('/kickboxing/superlourds', 'kickboxing_superlourds')]
    public function kickboxing100(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/kickboxing/kickboxingSuperLourds.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }



}