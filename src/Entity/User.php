<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * UniqueEntity(
     *  fields={"email"},
     *  message="L'email que vous avez saisi est déjà utilisé"
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date")
     */
    private $annee_naissance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="Autheur")
     */
    private $trajets;


/*
  Assert\EqualTo(propertyPath="password", message="Les deux mots de passes doivent être égaux")

*/

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password_confirm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="AutheurAvis")
     */
    private $avis;

    public function __construct()
    {
        $this->trajets = new ArrayCollection();
        $this->avis = new ArrayCollection();
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAnneeNaissance(): ?\DateTimeInterface
    {
        return $this->annee_naissance;
    }

    public function setAnneeNaissance(\DateTimeInterface $annee_naissance): self
    {
        $this->annee_naissance = $annee_naissance;

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getTrajets(): Collection
    {
        return $this->trajets;
    }

    public function addTrajet(Trajet $trajet): self
    {
        if (!$this->trajets->contains($trajet)) {
            $this->trajets[] = $trajet;
            $trajet->setAutheur($this);
        }

        return $this;
    }

    public function removeTrajet(Trajet $trajet): self
    {
        if ($this->trajets->contains($trajet)) {
            $this->trajets->removeElement($trajet);
            // set the owning side to null (unless already changed)
            if ($trajet->getAutheur() === $this) {
                $trajet->setAutheur(null);
            }
        }

        return $this;
    }

    public function getPasswordConfirm(): ?string
    {
        return $this->password_confirm;
    }

    public function setPasswordConfirm(string $password_confirm): self
    {
        $this->password_confirm = $password_confirm;

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
            $avi->setAutheurAvis($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->contains($avi)) {
            $this->avis->removeElement($avi);
            // set the owning side to null (unless already changed)
            if ($avi->getAutheurAvis() === $this) {
                $avi->setAutheurAvis(null);
            }
        }

        return $this;
    }
}
