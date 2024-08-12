<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminAccueilController extends AbstractController
{

    #[Route('/admin/accueil', 'admin_acceuil')]
    public function accueil()
    {
        return $this->render('admin/accueil.html.twig');
    }






}