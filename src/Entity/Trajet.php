<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Trajet")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */

class Trajet
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
    private $ville_depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville_arrivee;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure_depart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure_arrivee;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_places;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="date")
     */
    private $date_modification;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="reserve_trajet")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="avis_trajet")
     */
    private $avis;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_expiration;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Slug(fields={"ville_depart"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="trajets")
     */
    private $Autheur;


    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->date_creation = new \DateTime();
        $this->date_modification = new \DateTime();

        if (!$this->date_expiration) {
            $this->date_expiration = (clone $this->date_creation)->modify('+60 days');
        }
    }
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->date_modification = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleDepart(): ?string
    {
        return $this->ville_depart;
    }

    public function setVilleDepart(string $ville_depart): self
    {
        $this->ville_depart = $ville_depart;

        return $this;
    }

    public function getVilleArrivee(): ?string
    {
        return $this->ville_arrivee;
    }

    public function setVilleArrivee(string $ville_arrivee): self
    {
        $this->ville_arrivee = $ville_arrivee;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(\DateTimeInterface $heure_depart): self
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heure_arrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heure_arrivee): self
    {
        $this->heure_arrivee = $heure_arrivee;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nb_places;
    }

    public function setNbPlaces(int $nb_places): self
    {
        $this->nb_places = $nb_places;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setReserveTrajet($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getReserveTrajet() === $this) {
                $reservation->setReserveTrajet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setAvisTrajet($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->contains($avi)) {
            $this->avis->removeElement($avi);
            // set the owning side to null (unless already changed)
            if ($avi->getAvisTrajet() === $this) {
                $avi->setAvisTrajet(null);
            }
        }

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->date_expiration;
    }

    public function setDateExpiration(?\DateTimeInterface $date_expiration): self
    {
        $this->date_expiration = $date_expiration;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAutheur(): ?User
    {
        return $this->Autheur;
    }

    public function setAutheur(?User $Autheur): self
    {
        $this->Autheur = $Autheur;

        return $this;
    }
}
