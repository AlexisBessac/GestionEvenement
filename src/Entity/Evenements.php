<?php

namespace App\Entity;

use App\Repository\EvenementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EvenementsRepository::class)]
class Evenements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'Veuillez renseigner le titre de l\'événement',
    )]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Le titre doit faire au minimum {{ limit }} caractères',
        maxMessage: 'Le titre doit faire au maximum {{ limit }} caractères'
    )]
    private ?string $titre = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $EventAt = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'Veuillez renseigner le lieu de l\'événement',
    )]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Le lieu doit faire au minimum {{limit}} caractères',
        maxMessage: 'Le lieu doit faire au maximum {{limit}} caractères'
    )]
    private ?string $lieu = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Participant>
     */
    #[ORM\OneToMany(targetEntity: Participant::class, mappedBy: 'evenement')]
    private Collection $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEventAt(): ?\DateTimeImmutable
    {
        return $this->EventAt;
    }

    public function setEventAt(?\DateTimeImmutable $EventAt): static
    {
        $this->EventAt = $EventAt;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Participant>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setEvenement($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): static
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getEvenement() === $this) {
                $participant->setEvenement(null);
            }
        }

        return $this;
    }
}
