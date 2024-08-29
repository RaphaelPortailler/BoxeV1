<?php

declare(strict_types=1);

namespace App\Controller\admin;

use App\Entity\Commentaire;
use App\Entity\User;
use App\Form\CommentaireType;
use App\Form\UserType;
use App\Repository\CommentaireRepository;
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


class AdminGestCommentController extends AbstractController
{

    #[Route('/admin/gest-comments', name: 'admin_gestion_comments')]
    public function showComment(CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findAll();

        return $this->render('admin/gestComment.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }

    #[Route('/admin/gest-comment/insert', name: 'admin_insert_comments')]
    public function insertComment(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setDateCommentaire(new \DateTimeImmutable());

        $commentForm = $this->createForm(CommentaireType::class, $commentaire);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {


            $entityManager->persist($commentaire);
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire ajouté');

            return $this->redirectToRoute('admin_insert_comments');
        }

        $commentCreateFormView = $commentForm->createView();
        return $this->render('admin/insertComment.html.twig', [
            'commentForm' => $commentCreateFormView
        ]);
    }

}