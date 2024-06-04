<?php

namespace App\Controller;

use App\Entity\Email;
use App\Form\NewletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter/subscribe', name: 'app_newsletter')]
    public function subscribe(Request $request, EntityManagerInterface $em): Response
    {
        $newsletterEmail = new Email();
        $form = $this->createForm(NewletterType::class, $newsletterEmail); // Pour créer le formulaire

        $form->handleRequest(request: $request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($newsletterEmail);
            $em->flush();
            return $this->redirectToRoute('newsletter_thanks');
        }

        return $this->render('newsletter/subscribe.html.twig', [
            'newsletterForm' => $form
        ]);
    }

        #[Route('/newsletter/thanks/{email}', name: 'newsletter_thanks')]
        public function thanks(string $email): Response
    {
        return $this->render('newsletter/thanks.html.twig',
    [
        'email' => $email,
    ]);
    }
}