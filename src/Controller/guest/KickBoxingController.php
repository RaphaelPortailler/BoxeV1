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
    public function boxeThailandaise(BoxeurRepository $boxeurRepository): Response
    {
        return $this->render('guest/kickboxing/kickboxing.html.twig');
    }



}