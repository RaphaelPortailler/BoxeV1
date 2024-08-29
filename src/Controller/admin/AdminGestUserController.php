<?php

declare(strict_types=1);

namespace App\Controller\admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;


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


    #[Route('/admin/gest-user/insert', 'admin_insert_user')]
    public function insertUser(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // $boxeur->setUpdatedAt(new \DateTime('NOW'));

            $clearPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $clearPassword);
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'User Créer');
        }

        $userCreateFormView = $userForm->createView();

        return $this->render('admin/insertUser.html.twig', [
            'userForm' => $userCreateFormView
        ]);
    }


    #[Route('/admin/user/delete/{id}', name: 'delete_user')]
    public function deleteUser(int $id,UserRepository $userRepository , EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            $html = $this->renderView('admin/404.html.twig');
            return new Response($html, 404);
        }

        try{
            // j'utilise la classe entity manager
            // pour préparer la requête SQL de suppression
            // cette requête n'est pas executée tout de suite
            $entityManager->remove($user);
            // j'execute la / les requête SQL préparée
            $entityManager->flush();

            $this->addFlash('success', 'User bien supprimé');
        } catch(\Exception $exception){
            return $this->render('admin/error.html.twig', [
                'error' => $exception->getMessage()
            ]);
        }

        return $this->redirectToRoute('admin_gestion_user');
    }


    #[Route('/admin/user/update/{id}', name: 'update_user')]
    public function updateUser(int $id, UserRepository $userRepository , Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);

        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid())
        {

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'User modifier');
        }

        $userCreateFormView = $userForm->createView();

        return $this->render('admin/updateUser.html.twig', [
            'userForm' => $userCreateFormView
        ]);

    }



}


