<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomDeLaSociete = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_activite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_du_contact = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $post = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numero_du_contact = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email_du_contact = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notes = null;

    #[ORM\OneToOne(inversedBy: 'client', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, JobOffer>
     */
    #[ORM\OneToMany(targetEntity: JobOffer::class, mappedBy: 'client')]
    private Collection $offreEmplois;

    public function __construct()
    {
        $this->offreEmplois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDeLaSociete(): ?string
    {
        return $this->nomDeLaSociete;
    }

    public function setNomDeLaSociete(?string $nomDeLaSociete): static
    {
        $this->nomDeLaSociete = $nomDeLaSociete;

        return $this;
    }

    public function getTypeActivite(): ?string
    {
        return $this->type_activite;
    }

    public function setTypeActivite(?string $type_activite): static
    {
        $this->type_activite = $type_activite;

        return $this;
    }

    public function getNomDuContact(): ?string
    {
        return $this->nom_du_contact;
    }

    public function setNomDuContact(?string $nom_du_contact): static
    {
        $this->nom_du_contact = $nom_du_contact;

        return $this;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(?string $post): static
    {
        $this->post = $post;

        return $this;
    }

    public function getNumeroDuContact(): ?string
    {
        return $this->numero_du_contact;
    }

    public function setNumeroDuContact(?string $numero_du_contact): static
    {
        $this->numero_du_contact = $numero_du_contact;

        return $this;
    }

    public function getEmailDuContact(): ?string
    {
        return $this->email_du_contact;
    }

    public function setEmailDuContact(?string $email_du_contact): static
    {
        $this->email_du_contact = $email_du_contact;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, JobOffer>
     */
    public function getOffreEmplois(): Collection
    {
        return $this->offreEmplois;
    }

    public function addOffreEmploi(JobOffer $offreEmploi): static
    {
        if (!$this->offreEmplois->contains($offreEmploi)) {
            $this->offreEmplois->add($offreEmploi);
            $offreEmploi->setClient($this);
        }

        return $this;
    }

    public function removeOffreEmploi(JobOffer $offreEmploi): static
    {
        if ($this->offreEmplois->removeElement($offreEmploi)) {
            // set the owning side to null (unless already changed)
            if ($offreEmploi->getClient() === $this) {
                $offreEmploi->setClient(null);
            }
        }

        return $this;
    }
}
