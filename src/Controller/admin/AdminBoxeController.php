<?php

declare(strict_types=1);

namespace App\Controller\admin;

use App\Entity\Boxeur;
use App\Form\BoxeurType;
use App\Repository\BoxeurRepository;
use App\Repository\CategorieRepository;
use App\Repository\PeserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminBoxeController extends AbstractController
{
    #[Route('/admin/boxe', 'admin_boxe')]
    public function boxeAnglaise(BoxeurRepository $boxeurRepository):Response
    {
        $boxeur = $boxeurRepository->findAll();


        return $this->render('admin/adminBoxe.html.twig', [
            'boxeurs' => $boxeur
        ]);
    }



    #[Route('/admin/boxeur/insert', name: 'insert_boxeur')]
    public function insertArticle(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, ParameterBagInterface $params): Response
    {
        $boxeur = new Boxeur();

        $boxeurForm = $this->createForm(BoxeurType::class ,$boxeur);

        $boxeurForm->handleRequest($request);

        if ($boxeurForm->isSubmitted() && $boxeurForm->isValid()) {
            // $boxeur->setUpdatedAt(new \DateTime('NOW'));

            // récupérer le nom du fichier
            $imageFile = $boxeurForm->get('image')->getData();

            // si il y a bien un fichier envoyé
             if ($imageFile)
             {
                // je récupère son nom
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);

                // je nettoie le nom (sort les caractères spéciaux etc)
                $safeFilename = $slugger->slug($originalFilename);

                // je rajoute un identifiant unique au nom
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try
                {
                    // je récupère le chemin de la racine du projet
                    $rootPath = $params->get('kernel.project_dir');

                    // je déplace le fichier dans le dossier /public/upload en partant de la racine
                    // du projet, et je renomme le fichier avec le nouveau nom (slugifié et identifiant unique)
                    $imageFile->move( $rootPath.'/public/assets/uploads', $newFilename);
                } catch (FileException $e){
                    dd($e->getMessage());
                }

                // je stocke dans la propriété image de l'entité article le nom du fichier
                 $boxeur->setImage($newFilename);
            }

            $entityManager->persist($boxeur);
            $entityManager->flush();

            $this->addFlash('success', 'Boxeur Créer');
        }

        $boxeurCreateFormView = $boxeurForm->createView();

        return $this->render('admin/insertBoxeur.html.twig', [
            'boxeurForm' => $boxeurCreateFormView
        ]);
    }


    #[Route('/admin/boxeur/update/{id}', 'admin_update_boxeur')]
    public function updateArticle(int $id, Request $request, EntityManagerInterface $entityManager, BoxeurRepository $boxeurRepository, SluggerInterface $slugger, ParameterBagInterface $params): Response
    {
        $boxeur = $boxeurRepository->find($id);

        // Sauvegarder le nom de l'image existante avant de traiter le formulaire
        $existingImage = $boxeur->getImage();

        $boxeurForm = $this->createForm(BoxeurType::class, $boxeur);

        $boxeurForm->handleRequest($request);

        if ($boxeurForm->isSubmitted() && $boxeurForm->isValid())
        {
            // récupérer le nom du fichier
            $imageFile = $boxeurForm->get('image')->getData();

            // si il y a bien une image envoyé
            if ($imageFile)
            {
                // je récupère son nom
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);

                // je nettoie le nom (sort les caractères spéciaux etc)
                $safeFilename = $slugger->slug($originalFilename);

                // je rajoute un identifiant unique au nom
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try
                {
                    // je récupère le chemin de la racine du projet
                    $rootPath = $params->get('kernel.project_dir');

                    // je déplace le fichier dans le dossier /public/upload en partant de la racine
                    // du projet, et je renomme le fichier avec le nouveau nom (slugifié et identifiant unique)
                    $imageFile->move( $rootPath.'/public/assets/uploads', $newFilename);
                } catch (FileException $e){
                    dd($e->getMessage());
                }

                // je stocke dans la propriété image de l'entité article le nom du fichier
                $boxeur->setImage($newFilename);

            // Mettre à jour l'image avec le nouveau nom
            $boxeur->setImage($newFilename);
            } else {
            // Si aucun fichier n'est uploadé, conserver l'image existante
            $boxeur->setImage($existingImage);
            }

            $entityManager->persist($boxeur);
            $entityManager->flush();

            $this->addFlash('success', 'boxeur modifier');
        }

        $boxeurCreateFormView = $boxeurForm->createView();

        return $this->render('admin/updateBoxeur.html.twig', [
            'boxeurForm' => $boxeurCreateFormView
        ]);

    }


    #[Route('/admin/boxeur/delete/{id}', name: 'delete_boxeur')]
    public function deleteArticle(int $id, BoxeurRepository $boxeurRepository, EntityManagerInterface $entityManager): Response
    {
        $boxeur = $boxeurRepository->find($id);

        if (!$boxeur) {
            $html = $this->renderView('admin/404.html.twig');
            return new Response($html, 404);
        }

        try{
            // j'utilise la classe entity manager
            // pour préparer la requête SQL de suppression
            // cette requête n'est pas executée tout de suite
            $entityManager->remove($boxeur);
            // j'execute la / les requête SQL préparée
            $entityManager->flush();

            $this->addFlash('success', 'Boxeur bien supprimé');
        } catch(\Exception $exception){
            return $this->render('admin/error.html.twig', [
                'error' => $exception->getMessage()
            ]);
        }

        return $this->redirectToRoute('admin_boxe');
    }

}