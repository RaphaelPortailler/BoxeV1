<?php

declare(strict_types=1);

namespace App\Controller\admin;

use App\Repository\BoxeurRepository;
use App\Repository\CategorieRepository;
use App\Repository\PeserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBoxeController extends AbstractController
{
    #[Route('/admin/boxe', 'admin_boxe')]
    public function boxeAnglaise(BoxeurRepository $boxeurRepository, PeserRepository $peserRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();

        $peser = $peserRepository->findAll();

        return $this->render('admin/adminBoxe.html.twig', [
            'boxeurs' => $boxeur,
            'pesers' => $peser
        ]);
    }



}