<?php

declare(strict_types=1);

namespace App\Controller\guest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BoxeurRepository;
use Symfony\Component\Routing\Annotation\Route;

class BoxeFrancaiseController extends AbstractController
{

    #[Route('/boxe-francaise', 'home_boxe_francaise')]
    public function boxeThailandaise(): Response
    {
        return $this->render('guest/francaise/francaise.html.twig');
    }


    #[Route('/boxe-francaise/superplumes', 'boxe_francaise_superplumes')]
    public function kickboxing57(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/francaise/francaiseSuperPlumes.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }


    #[Route('/boxe-francaise/superlourds', 'boxe_francaise_superlourds')]
    public function kickboxing100(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        return $this->render('guest/francaise/francaiseSuperLourds.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }



}