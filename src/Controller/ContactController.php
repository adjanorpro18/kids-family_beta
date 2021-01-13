<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            // On instance Swift_Mailer
            $message = (new \Swift_Message('Nouveau Contact'))
                //  On attribue l'expéditeur
            ->setFrom($contact['email'])
                // On attribue le destinataire
            ->setTo('stage.symfony2021@gmail.com')
                // On crée le contenue du message avec la vue Twig
            ->setBody(
                $this->renderView(
                    'emails/contact.html.twig', compact('contact')
                ),
                    'text/html'
                );

            // on envoie le message
            $mailer->send($message);
            $this->addFlash('message', 'Le message a bien été envoyé');
            return $this->redirectToRoute('app_index');

        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
