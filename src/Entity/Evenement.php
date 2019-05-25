<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 * @Vich\Uploadable
 */
class Evenement
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
    private $libelle;

    /**
     * @ORM\Column(type="text")
     */
    private $texte;

    /**
     * @ORM\Column(type="date")
     */
    private $date_evenement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="evenements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="evenements")
     */
    private $Evenement_categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="Evenement_categorie")
     */
    private $evenements;

    /**
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     * @var string
     */
    private $photo;

    /**
     * @Vich\UploadableField(mapping="evenement_images", fileNameProperty="photo")
     * @var File
     * @Assert\Image(mimeTypes={ "image/jpeg", "image/jpg", "image/png"  }, mimeTypesMessage = "Extension valide : .jpeg .png .jpg", groups = {"create"})
     *
     */
    private $photoFile;

    /**
     * Evenement constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->setDateEvenement(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;
        return $this;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->date_evenement;
    }

    public function setDateEvenement(\DateTimeInterface $date_evenement): self
    {
        $this->date_evenement = $date_evenement;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getEvenementCategorie(): ?self
    {
        return $this->Evenement_categorie;
    }

    public function setEvenementCategorie(?self $Evenement_categorie): self
    {
        $this->Evenement_categorie = $Evenement_categorie;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(self $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setEvenementCategorie($this);
        }

        return $this;
    }

    public function removeEvenement(self $evenement): self
    {
        if ($this->evenements->contains($evenement)) {
            $this->evenements->removeElement($evenement);
            // set the owning side to null (unless already changed)
            if ($evenement->getEvenementCategorie() === $this) {
                $evenement->setEvenementCategorie(null);
            }
        }

    
        return $this;
    }
    public function __toString()
    {
        return (string) $this->getUtilisateur();

    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }
    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    public function setPhotoFile(File $photo = null)
    {
        $this->photoFile = $photo;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($photo) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPhotoFile()
    {
        return $this->photoFile;
    }


}
