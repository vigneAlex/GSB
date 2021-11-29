<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VisitesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitesRepository::class)
 * @ApiResource
 */
class Visites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $vst_dateVisite;

    /**
     * @ORM\Column(type="text")
     */
    private $vst_commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Praticiens::class, inversedBy="pra_visites")
     */
    private $vst_praticien;

    /**
     * @ORM\ManyToOne(targetEntity=Motifs::class, inversedBy="mot_visites")
     */
    private $vst_motif;

    /**
     * @ORM\ManyToOne(targetEntity=Visiteurs::class, inversedBy="vis_visites")
     */
    private $vst_visiteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVstDateVisite(): ?\DateTimeInterface
    {
        return $this->vst_dateVisite;
    }

    public function setVstDateVisite(\DateTimeInterface $vst_dateVisite): self
    {
        $this->vst_dateVisite = $vst_dateVisite;

        return $this;
    }

    public function getVstCommentaire(): ?string
    {
        return $this->vst_commentaire;
    }

    public function setVstCommentaire(string $vst_commentaire): self
    {
        $this->vst_commentaire = $vst_commentaire;

        return $this;
    }

    public function getVstPraticien(): ?Praticiens
    {
        return $this->vst_praticien;
    }

    public function setVstPraticien(?Praticiens $vst_praticien): self
    {
        $this->vst_praticien = $vst_praticien;

        return $this;
    }

    public function getVstMotif(): ?Motifs
    {
        return $this->vst_motif;
    }

    public function setVstMotif(?Motifs $vst_motif): self
    {
        $this->vst_motif = $vst_motif;

        return $this;
    }

    public function getVstVisiteur(): ?Visiteurs
    {
        return $this->vst_visiteur;
    }

    public function setVstVisiteur(?Visiteurs $vst_visiteur): self
    {
        $this->vst_visiteur = $vst_visiteur;

        return $this;
    }
}
