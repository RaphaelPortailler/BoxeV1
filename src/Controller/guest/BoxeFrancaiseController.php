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
    public function boxeThailandaise(BoxeurRepository $boxeurRepository): Response
    {
        return $this->render('guest/francaise.html.twig');
    }



}