<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function sendMessage(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contactFormData = $form->getData();

            $message = (new Email())
            ->from($contactFormData['email'])
            ->to('lafourchettevictorieuse@gmail.com')
            ->subject($contactFormData['subject'])
            ->text(
                'Expéditeur : ' . $contactFormData['email'] . \PHP_EOL 
                . 'Nom : ' . $contactFormData['name'] . \PHP_EOL
                . 'Prénom : '. $contactFormData['firstname'] . \PHP_EOL
                . 'Message : ' . \PHP_EOL . $contactFormData['message'],
             'text/plain');
             $mailer->send($message);

             $this->addFlash('success', 'Vore message a été envoyé');
             return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'ContactController',
        ]);
    }
}
