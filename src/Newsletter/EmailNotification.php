<?php

namespace App\Newsletter;
use App\Entity\Email as Mail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

Class EmailNotification {
    public function __construct(
    private MailerInterface $mailer, 
    private string $adminEmail
    ) {
    }

    public function sendConfirmationEmail (Mail $newEmail) : void
    {
        //Envoyer un mail :
        $email = (new Email())
        ->from($this->adminEmail)
        ->to($newEmail->getEmail())
        ->subject('Inscription à la newsletter')
        ->text('Sending emails is fun again!');
        // ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }
}