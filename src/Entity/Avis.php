<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 */
class Avis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $date_publication;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="avis")
     */
    private $AutheurAvis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trajet", inversedBy="avis")
     */
    private $AvisTrajet;


    public function __construct(){
    
        $this->date_publication = new \DateTime();
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getAutheurAvis(): ?User
    {
        return $this->AutheurAvis;
    }

    public function setAutheurAvis(?User $AutheurAvis): self
    {
        $this->AutheurAvis = $AutheurAvis;

        return $this;
    }

    public function getAvisTrajet(): ?Trajet
    {
        return $this->AvisTrajet;
    }

    public function setAvisTrajet(?Trajet $AvisTrajet): self
    {
        $this->AvisTrajet = $AvisTrajet;

        return $this;
    }

}
