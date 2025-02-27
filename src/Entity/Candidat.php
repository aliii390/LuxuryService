<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Attribute\ProfileCompletion;

#[ORM\Entity(repositoryClass: CandidatRepository::class)]
class Candidat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $lastname = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $birthdate = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $birthplace = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $nationality = null;

    #[ORM\ManyToOne(inversedBy: 'candidats')]
    #[ProfileCompletion]
    private ?Gender $gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $experience = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $descritpion = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $profilePictureFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $passportPictureFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[ProfileCompletion]
    private ?string $cvPictureFile = null;

    #[ORM\ManyToOne(inversedBy: 'candidats')]
    #[ProfileCompletion]
    private ?JobCategory $jobCategory = null;

    /**
     * @var Collection<int, Candidature>
     */
    #[ORM\OneToMany(targetEntity: Candidature::class, mappedBy: 'candidat')]
    private Collection $candidatures;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleteAt = null;

    public function __construct()
    {
        $this->candidatures = new ArrayCollection();
    }

    

    public function __toString()
    {
        return $this->firstname;
    }
  


    // #[ORM\Column(nullable: true)]
    // private ?\DateTimeImmutable $createdAt = null;

    // #[ORM\Column(nullable: true)]
    // private ?\DateTimeImmutable $deletedAt = null;


 
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    public function setBirthdate(?string $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(?string $birthplace): static
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDescritpion(): ?string
    {
        return $this->descritpion;
    }

    public function setDescritpion(?string $descritpion): static
    {
        $this->descritpion = $descritpion;

        return $this;
    }

    public function getProfilePictureFile(): ?string
    {
        return $this->profilePictureFile;
    }

    public function setProfilePictureFile(?string $profilePictureFile): static
    {
        $this->profilePictureFile = $profilePictureFile;

        return $this;
    }

    public function getPassportPictureFile(): ?string
    {
        return $this->passportPictureFile;
    }

    public function setPassportPictureFile(?string $passportPictureFile): static
    {
        $this->passportPictureFile = $passportPictureFile;

        return $this;
    }

    public function getCvPictureFile(): ?string
    {
        return $this->cvPictureFile;
    }

    public function setCvPictureFile(?string $cvPictureFile): static
    {
        $this->cvPictureFile = $cvPictureFile;

        return $this;
    }

    public function getJobCategory(): ?JobCategory
    {
        return $this->jobCategory;
    }

    public function setJobCategory(?JobCategory $jobCategory): static
    {
        $this->jobCategory = $jobCategory;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): static
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures->add($candidature);
            $candidature->setCandidat($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): static
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getCandidat() === $this) {
                $candidature->setCandidat(null);
            }
        }

        return $this;
    }

    public function getDeleteAt(): ?\DateTimeImmutable
    {
        return $this->deleteAt;
    }

    public function setDeleteAt(?\DateTimeImmutable $deleteAt): static
    {
        $this->deleteAt = $deleteAt;

        return $this;
    }

 

    
}



// je peut faire de migr pour rajouter ville et adress a cause de user_id je comprend pas 
