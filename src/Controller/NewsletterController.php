<?php

namespace App\Controller;

use App\Entity\Email as Mail;
use App\Form\NewletterType;
use App\Newsletter\EmailNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter/subscribe', name: 'app_newsletter')]
    public function subscribe(Request $request, EntityManagerInterface $em, EmailNotification $emailNotification): Response
    {
        $newsletterEmail = new Mail();
        $form = $this->createForm(NewletterType::class, $newsletterEmail); // Pour créer le formulaire

        $form->handleRequest(request: $request);

        if ($form->isSubmitted() && $form->isValid()) { //Vérification de la validité du formulaire
            $em->persist($newsletterEmail);
            $em->flush();

            $emailNotification->sendConfirmationEmail($newsletterEmail);

            return $this->redirectToRoute('newsletter_thanks');
        }

        return $this->render('newsletter/subscribe.html.twig', [
            'newsletterForm' => $form
        ]);
    }

    #[Route('/newsletter/thanks', name: 'newsletter_thanks')]
    public function thanks(): Response
    {
        return $this->render('newsletter/thanks.html.twig');
    }
}