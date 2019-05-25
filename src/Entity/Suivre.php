<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuivreRepository")
 */
class Suivre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="suivis")
     */
    private $utilisateur_from;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="suiveurs")
     */
    private $utilisateur_to;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateurFrom(): ?Utilisateur
    {
        return $this->utilisateur_from;
    }

    public function setUtilisateurFrom(?Utilisateur $utilisateur_from): self
    {
        $this->utilisateur_from = $utilisateur_from;

        return $this;
    }

    public function getUtilisateurTo(): ?Utilisateur
    {
        return $this->utilisateur_to;
    }

    public function setUtilisateurTo(?Utilisateur $utilisateur_to): self
    {
        $this->utilisateur_to = $utilisateur_to;

        return $this;
    }

    
}
