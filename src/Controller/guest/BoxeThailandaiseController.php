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
    public function boxeThailandaise(BoxeurRepository $boxeurRepository): Response
    {
        return $this->render('guest/thailandaise/thailandaise.html.twig');
    }



}