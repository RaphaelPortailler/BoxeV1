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

    #[Route('/admin/gest-comment/delete/{id}', name: 'admin_delete_comments')]
    public function deleteComment(int $id, CommentaireRepository $commentaireRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = $commentaireRepository->find($id);

        if (!$comment) {
            $html = $this->renderView('admin/404.html.twig');
            return new Response($html, 404);
        }

        try {
            $entityManager->remove($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire bien supprimé');
        } catch (\Exception $exception) {
            return $this->render('admin/error.html.twig', [
                'error' => $exception->getMessage()
            ]);
        }

        return $this->redirectToRoute('admin_gestion_comments');
    }

    #[Route('/admin/gest-comment/update/{id}', name: 'admin_update_comments')]
    public function updateComments(int $id, CommentaireRepository $commentaireRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = $commentaireRepository->find($id);

        $commentForm = $this->createForm(CommentaireType::class, $comment);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire modifier');
        }

        $commentCreateFormView = $commentForm->createView();

        return $this->render('admin/updateComment.html.twig', [
            'commentForm' => $commentCreateFormView
        ]);
    }


}
