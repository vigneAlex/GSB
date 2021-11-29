<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MotifsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotifsRepository::class)
 * @ApiResource
 */
class Motifs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mot_libelle;

    /**
     * @ORM\OneToMany(targetEntity=Visites::class, mappedBy="vst_motif")
     */
    private $mot_visites;

    public function __construct()
    {
        $this->mot_visites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotLibelle(): ?string
    {
        return $this->mot_libelle;
    }

    public function setMotLibelle(string $mot_libelle): self
    {
        $this->mot_libelle = $mot_libelle;

        return $this;
    }

    /**
     * @return Collection|Visites[]
     */
    public function getMotVisites(): Collection
    {
        return $this->mot_visites;
    }

    public function addMotVisite(Visites $motVisite): self
    {
        if (!$this->mot_visites->contains($motVisite)) {
            $this->mot_visites[] = $motVisite;
            $motVisite->setVstMotif($this);
        }

        return $this;
    }

    public function removeMotVisite(Visites $motVisite): self
    {
        if ($this->mot_visites->removeElement($motVisite)) {
            // set the owning side to null (unless already changed)
            if ($motVisite->getVstMotif() === $this) {
                $motVisite->setVstMotif(null);
            }
        }

        return $this;
    }
}
