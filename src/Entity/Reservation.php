<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_reservation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $annulation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trajet", inversedBy="reservations")
     */
    private $reserve_trajet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): self
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(bool $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function getAnnulation(): ?bool
    {
        return $this->annulation;
    }

    public function setAnnulation(bool $annulation): self
    {
        $this->annulation = $annulation;

        return $this;
    }

    public function getReserveTrajet(): ?Trajet
    {
        return $this->reserve_trajet;
    }

    public function setReserveTrajet(?Trajet $reserve_trajet): self
    {
        $this->reserve_trajet = $reserve_trajet;

        return $this;
    }
}
