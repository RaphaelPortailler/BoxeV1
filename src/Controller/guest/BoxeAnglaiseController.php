<?php

declare(strict_types=1);

namespace App\Controller\guest;

use App\Repository\CategorieRepository;
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
    public function boxeAnglaise57(BoxeurRepository $boxeurRepository, CategorieRepository $categorieRepository, TypeBoxeRepository $typeBoxeRepository): Response
    {
        $typeBoxe = $typeBoxeRepository->findOneById(1);
        $category = $categorieRepository->findOneById(1);

        if ($typeBoxe && $category) {
            $boxeurs = $boxeurRepository->findByTypeAndCategory($typeBoxe, $category);
        }
        return $this->render('guest/anglaise/anglaiseSuperPlumes.html.twig', [
            'category' => $category,
            'boxeurs' => $boxeurs,
            'typeBoxe' => $typeBoxe
        ]);
    }



    #[Route('/boxe-anglaise/superlourd', 'boxe_anglaise_superlourd')]
    public function boxeAnglaise64(BoxeurRepository $boxeurRepository, CategorieRepository $categorieRepository, TypeBoxeRepository $typeBoxeRepository): Response
    {
        $typeBoxe = $typeBoxeRepository->findOneById(1);
        $category = $categorieRepository->findOneById(2);

        if ($typeBoxe && $category) {
            $boxeurs = $boxeurRepository->findByTypeAndCategory($typeBoxe, $category);
        }
        return $this->render('guest/anglaise/anglaiseSuperLourds.html.twig', [
            'category' => $category,
            'boxeurs' => $boxeurs,
            'typeBoxe' => $typeBoxe
        ]);

    }


    #[Route('/show-boxeur/{id}', name: 'show_boxeur')]
    public function showBoxeur(int $id, BoxeurRepository $boxeurRepository ):Response
    {
        $boxeurs = $boxeurRepository->find($id);

        if (!$boxeurs) {
            $html404 = $this->renderView('guest/404.html.twig');
            return new Response($html404, 404);
        }

        return $this->render('guest/showBoxeur.html.twig', [
            'boxeur' => $boxeurs
        ]);
    }
}

