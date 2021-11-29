<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VisiteursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=VisiteursRepository::class)
 * @ApiResource
 */
class Visiteurs implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vis_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vis_prenom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $vis_tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vis_dateEmbauche;

    /**
     * @ORM\OneToMany(targetEntity=Visites::class, mappedBy="vst_visiteur")
     */
    private $vis_visites;

    public function __construct()
    {
        $this->vis_visites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getVisNom(): ?string
    {
        return $this->vis_nom;
    }

    public function setVisNom(?string $vis_nom): self
    {
        $this->vis_nom = $vis_nom;

        return $this;
    }

    public function getVisPrenom(): ?string
    {
        return $this->vis_prenom;
    }

    public function setVisPrenom(?string $vis_prenom): self
    {
        $this->vis_prenom = $vis_prenom;

        return $this;
    }

    public function getVisTel(): ?string
    {
        return $this->vis_tel;
    }

    public function setVisTel(?string $vis_tel): self
    {
        $this->vis_tel = $vis_tel;

        return $this;
    }

    public function getVisDateEmbauche(): ?string
    {
        return $this->vis_dateEmbauche;
    }

    public function setVisDateEmbauche(?string $vis_dateEmbauche): self
    {
        $this->vis_dateEmbauche = $vis_dateEmbauche;

        return $this;
    }

    /**
     * @return Collection|Visites[]
     */
    public function getVisVisites(): Collection
    {
        return $this->vis_visites;
    }

    public function addVisVisite(Visites $visVisite): self
    {
        if (!$this->vis_visites->contains($visVisite)) {
            $this->vis_visites[] = $visVisite;
            $visVisite->setVstVisiteur($this);
        }

        return $this;
    }

    public function removeVisVisite(Visites $visVisite): self
    {
        if ($this->vis_visites->removeElement($visVisite)) {
            // set the owning side to null (unless already changed)
            if ($visVisite->getVstVisiteur() === $this) {
                $visVisite->setVstVisiteur(null);
            }
        }

        return $this;
    }
}
