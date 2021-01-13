<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ResetPasswordController extends AbstractController
{
    private $manager;
    private $flashy;

    public function __construct(EntityManagerInterface $manager, FlashyNotifier $flashy)
    {
        $this->manager = $manager;
        $this->flashy = $flashy;

    }

    /**
     * Requête pour réinitilaiser le mot de passe
     * @Route("/request", name="password_request")
     */
    public function request(Request $request, UserRepository $userRepository): Response
    {

        $utilisateur = $userRepository->findOneBy(['email'=> $request->request->get('email')]);
        if($utilisateur){
            return $this->redirectToRoute('password_reset', ['id'=>$utilisateur->getId()]);
        }elseif ($request->isMethod('POST')){
            $this->flashy->error('Cet addresse email ne correspond à aucun utilisateur');
            $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/request.html.twig');
    }

    /**
     * Réinitilaiser son mot de passe
     * @Route("/reset/{id}", name="password_reset", requirements= {"id":"\d+"})
     */
    public function reset(Request $request, UserPasswordEncoderInterface $encoder, User $utilisateur)
    {

        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //On va encoder le password
            $hashed = $encoder->encodePassword($utilisateur, $form->get('plainPassword')->getData());
            $utilisateur->setPassword($hashed);
            $this->manager->flush();

            $this->flashy->success('Votre mot de passe a été bien réinitialisé !');
            return $this->redirectToRoute('app_login');

        }

        return $this->render('reset_password/reset.html.twig',[
            'resetForm'=>$form->createView(),
        ]);
    }

}
