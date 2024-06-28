<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'Veuillez renseigner votre nom',
    )]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Votre nom doit faire au minimum {{limit}} caractères',
        maxMessage: 'Votre nom doit faire au maximum {{limit}} caractères'
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'Veuillez renseigner votre prénom',
    )]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Votre prénom doit faire au minimum {{limit}} caractères',
        maxMessage: 'Votre prénom doit faire au maximum {{limit}} caractères'
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    #[Assert\Email(
        message: 'L\'email  {{ value }} n\'est pas valide.',
    )]
    #[Assert\Unique]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    private ?Evenements $evenement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getEvenement(): ?Evenements
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenements $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
    }
}
