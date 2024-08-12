<?php

declare(strict_types=1);

namespace App\Controller\admin;

use App\Repository\BoxeurRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBoxeController extends AbstractController
{
    #[Route('/admin/boxe', 'admin_boxe')]
    public function boxeAnglaise(BoxeurRepository $boxeurRepository, CategorieRepository $categorieRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();
        $categorie = $categorieRepository->findAll();

        return $this->render('admin/adminBoxe.html.twig', [
            'boxeurs' => $boxeur,
            'categories' => $categorie
        ]);
    }



}