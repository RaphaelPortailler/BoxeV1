<?php

declare(strict_types=1);

// on créer un namespace qui permet d'identifier le chemin afin d'utiliser la class actuelle
namespace App\Controller\guest;

// on appelle le chemin(namespace) des classe utilisé et symfony fera le require de ces class
use App\Entity\User;
use App\Form\UserType;
use App\Repository\BoxeurRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

// on étend la class AbstractController qui permet d'utiliser des fonctions utilitaires pour les
// controllers (twig etc)
class IndexController extends AbstractController
{
    // #[Route est une annotation qui permet de créer une route, c'est a dire une nouvelle page sur notre appli quand
    // l'url est appelé et ça éxécute automatiquement la méthode définit sous la route
    // #[Route('/', 'home')]
    // public function index(BoxeurRepository $boxeurRepository)
    // {
        // $boxeurs = $boxeurRepository->findAll();

        // return $this->render('guest/index.html.twig', [
            // 'boxeurs' => $boxeurs,
        // ]);
    // }

    #[Route('/', name: 'home')]
    public function randomBoxeur(BoxeurRepository $boxeurRepository):Response
    {
        $boxeurs = $boxeurRepository->findAll();
        $randomBoxeurs = [];

        if (!empty($boxeurs)) {
            $randomBoxeurs = array_rand($boxeurs, min(4, count($boxeurs)));
            $randomBoxeurs = array_map(fn($key) => $boxeurs[$key], $randomBoxeurs);
        }

        // Appel de l'API externe
        //$client = HttpClient::create(['verify_peer' => false]);
        //$response = $client->request('GET', 'https://boxingdata.onrender.com/api/boxers'); // URL de l'API

        // Dump la réponse brute pour vérifier si la requête a fonctionné
        //dump($response->getContent()); // Montre le contenu brut de la réponse de l'API
        //exit(); // Arrête l'exécution pour afficher le contenu

        // Vérification de la réponse
        //if ($response->getStatusCode() === 200) {
            //$apiBoxeurs = $response->toArray(); // Convertir en tableau associatif
            //dd($apiBoxeurs);
        //} else {
            //$apiBoxeurs = []; // Si erreur, tableau vide
        //}

        return $this->render('guest/index.html.twig', [
            'boxeurs' => $boxeurs,
            'randomBoxeurs' => $randomBoxeurs,
            //'apiBoxeurs' => $apiBoxeurs
        ]);
    }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(EntityManagerInterface $entityManager, Request $request, UserPasswordHasherInterface $passwordHasher):Response
    {
        $user = new User();

        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if($userForm->isSubmitted() && $userForm->isValid()) {

            $clearPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $clearPassword);
            $user->setPassword($hashedPassword);

            $user->setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre compte a bien été créer');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('guest/inscription.html.twig', [
            'userForm' => $userForm->createView()

        ]);
    }

}