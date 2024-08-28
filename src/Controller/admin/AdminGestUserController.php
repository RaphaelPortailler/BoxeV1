<?php

declare(strict_types=1);

namespace App\Controller\admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminGestUserController extends AbstractController
{

    #[Route('/admin/gest-user', 'admin_gestion_user')]
    public function gestUser(UserRepository $userRepository):Response
    {
        $user = $userRepository->findAll();

        return $this->render('admin/gestUser.html.twig', [
            'users' => $user
        ]);
    }



}


