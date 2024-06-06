<?php

namespace App\Entity;

use App\Repository\EmailRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert; //Pour pouvoir intégrer les asserts

#[ORM\Entity(repositoryClass: EmailRepository::class)]
#[UniqueEntity("email", "Cet email existe déjà.")] //Pour que si le mail est déjà existant alors il affiche le message d'erreur
class Email
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "email obligatoire")] // L'email ne peut pas être vide. Pour contrôler la validation côté serveur.
    #[Assert\Email(message : "email invalide")] //Pour asserter que c'est un email il va vérifier s'il est conforme au format.
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
