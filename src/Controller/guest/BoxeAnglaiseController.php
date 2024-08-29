<?php

declare(strict_types=1);

namespace App\Controller\guest;

use App\Entity\Commentaire;
use App\Entity\TypeBoxe;
use App\Form\CommentaireType;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use App\Repository\PratiqueRepository;
use App\Repository\TypeBoxeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\BoxeurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoxeAnglaiseController extends AbstractController
{

    #[Route('/boxe-anglaise', 'home_boxe_anglaise')]
    public function boxeAnglaise(BoxeurRepository $boxeurRepository, TypeBoxeRepository $typeBoxeRepository)
    {

        $typeBoxe = $typeBoxeRepository->findOneById(1);

        if ($typeBoxe) {
            $boxeurs = $boxeurRepository->findByTypeBoxe($typeBoxe);

            return $this->render('guest/anglaise/anglaise.html.twig', [
                'boxeurs' => $boxeurs,
                'typeBoxe' => $typeBoxe
            ]);
        }
        return $this->render('guest/404.html.twig');
    }


    #[Route('/boxe-anglaise/superplumes', 'boxe_anglaise_superplumes')]
    public function boxeAnglaise57(BoxeurRepository $boxeurRepository, CategorieRepository $categorieRepository, TypeBoxeRepository $typeBoxeRepository): Response
    {
        $typeBoxe = $typeBoxeRepository->findOneById(1);
        $category = $categorieRepository->findOneById(1);

        if ($typeBoxe && $category) {
            $boxeurs = $boxeurRepository->findByTypeAndCategory($typeBoxe, $category);
        }
        return $this->render('guest/anglaise/anglaiseSuperPlumes.html.twig', [
            'category' => $category,
            'boxeurs' => $boxeurs,
            'typeBoxe' => $typeBoxe
        ]);
    }



    #[Route('/boxe-anglaise/superlourd', 'boxe_anglaise_superlourd')]
    public function boxeAnglaise64(BoxeurRepository $boxeurRepository, CategorieRepository $categorieRepository, TypeBoxeRepository $typeBoxeRepository): Response
    {
        $typeBoxe = $typeBoxeRepository->findOneById(1);
        $category = $categorieRepository->findOneById(2);

        if ($typeBoxe && $category) {
            $boxeurs = $boxeurRepository->findByTypeAndCategory($typeBoxe, $category);
        }
        return $this->render('guest/anglaise/anglaiseSuperLourds.html.twig', [
            'category' => $category,
            'boxeurs' => $boxeurs,
            'typeBoxe' => $typeBoxe
        ]);

    }


    #[Route('/show-boxeur/{id}', name: 'show_boxeur')]
    public function showBoxeur(int $id, BoxeurRepository $boxeurRepository,Request $request, EntityManagerInterface $entityManager,CommentaireRepository $commentaireRepository):Response
    {
        $boxeur = $boxeurRepository->find($id);

        if (!$boxeur) {
            $html404 = $this->renderView('guest/404.html.twig');
            return new Response($html404, 404);
        }

        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        $commentaire = new Commentaire();
        $commentaire->setBoxeur($boxeur);
        $commentaire->setUser($user);
        $commentaire->setDateCommentaire(new \DateTime());

        // Créer le formulaire de commentaire
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($commentaire);
            $entityManager->flush();

            // Redirection pour éviter la double soumission
            return $this->redirectToRoute('show_boxeur', ['id' => $boxeur->getId()]);
        }

        $commentaires = $commentaireRepository->findBy(['Boxeur' => $boxeur]);



        return $this->render('guest/showBoxeur.html.twig', [
            'boxeur' => $boxeur,
            'commentaires' => $commentaires,
            'form' => $form->createView()
        ]);
    }

}

