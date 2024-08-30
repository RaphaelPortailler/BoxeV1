//<?php

//namespace App\Controller\admin\Password;

//use Doctrine\ORM\EntityManagerInterface;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
//use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Mailer\MailerInterface;
//use Symfony\Component\Mime\Email;
//use App\Entity\User;
//use App\Repository\UserRepository;
//use Symfony\Component\String\Slugger\SluggerInterface;

//class PasswordResetController extends AbstractController
//{
    //#[Route('/forgot-password', name: 'forgot_password', methods: ['POST', 'GET'])]
    //public function forgotPassword(Request $request, UserRepository $userRepository, MailerInterface $mailer, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    //{
        //if ($request->isMethod('POST')) {
            //$email = $request->request->get('Email');

            //$user = $userRepository->findOneBy(['Email' => $email]);
            //if ($user) {
                //$resetToken = $slugger->slug(uniqid());

                //$user->setResetToken($resetToken);
                //$entityManager->persist($user);
                //$entityManager->flush();

                //$resetUrl = $this->generateUrl('reset_password', ['token' => $resetToken], true);

                //$email = (new Email())
                    //->from('raphael.portailler@lapiscine.pro')
                    //->to($user->getEmail())
                    //->subject('Réinitialisation de votre mot de passe')
                    //->html('<p>Cliquer sur le lien suivant pour réinitialiser votre mot de passe : <a href="'. $resetUrl .'">Réinitialiser le mot de passe</a></p>');

                //try{
                    //$mailer->send($email);
                    //return new Response('Un e-mail de réinitialisation a été envoyé à votre adresse e-mail.');
                //} catch (TransportExceptionInterface $e){
                    //return new Response('Echec de l\'envoi de l\'e-mail : ' . $e->getMessage(), 500);
                //}

            //}

            //return new Response('Aucun utilisateur trouvé pour cet e-mail.');
        //}

        //return $this->render('security/forgotPassword.html.twig');
    //}



    //#[Route('/reset-password/{token}', name: 'reset_password')]
    //public function resetPassword(Request $request, UserRepository $userRepository, string $token): Response
    //{
        //$user = $userRepository->findOneBy(['resetToken' => $token]);

        //if ($user) {
            //if ($request->isMethod('POST')) {
                //$newPassword = $request->request->get('password');

                //$encodedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                //$user->setPassword($encodedPassword);
                //$user->setResetToken(null);

                //$userRepository->save($user);

                //return new Response('Mot de passe réinitialisé avec succès !');
            //}

            //return $this->render('security/resetPassword.html.twig', [
                //'token' => $token,
            //]);
        //}

        //return new Response('Token invalide', 400);
    //}
//}