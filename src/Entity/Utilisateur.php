<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Vich\Uploadable
 */
class Utilisateur implements UserInterface, \Serializable
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commune;


    /**
     * @Assert\Regex("/^[0-9]{5}$/")
     * @ORM\Column(type="string", length=255)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $departement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site_web;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_entreprise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_association;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_president;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom_president;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="utilisateur")
     */
    private $evenements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="Utilisateur")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Album", mappedBy="utilisateur")
     */
    private $albums;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aime", mappedBy="utilisateur")
     */
    private $aimes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Suivre", mappedBy="utilisateur_from")
     */
    private $suivis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Suivre", mappedBy="utilisateur_to")
     */
    private $suiveurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="utilisateur")
     */
    private $commentaires;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     * @var string
     */
    private $photo;

    /**
     * @Vich\UploadableField(mapping="utilisateur_images", fileNameProperty="photo")
     * @var File
     * @Assert\Image(mimeTypes={ "image/jpeg", "image/jpg", "image/png"  }, mimeTypesMessage = "Extension valide : .jpeg .png .jpg", groups = {"create"})
     */
    private $photoFile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="utilisateur", orphanRemoval=true)
     */
    private $articles;





    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->produits = new ArrayCollection();
        $this->albums = new ArrayCollection();
        $this->aimes = new ArrayCollection();
        $this->suivis = new ArrayCollection();
        $this->suiveurs = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->site_web;
    }

    public function setSiteWeb(string $site_web): self
    {
        $this->site_web = $site_web;

        return $this;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nom_entreprise;
    }

    public function setNomEntreprise(?string $nom_entreprise): self
    {
        $this->nom_entreprise = $nom_entreprise;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNomAssociation(): ?string
    {
        return $this->nom_association;
    }

    public function setNomAssociation(?string $nom_association): self
    {
        $this->nom_association = $nom_association;

        return $this;
    }

    public function getNomPresident(): ?string
    {
        return $this->nom_president;
    }

    public function setNomPresident(?string $nom_president): self
    {
        $this->nom_president = $nom_president;

        return $this;
    }

    public function getPrenomPresident(): ?string
    {
        return $this->prenom_president;
    }

    public function setPrenomPresident(?string $prenom_president): self
    {
        $this->prenom_president = $prenom_president;

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setUtilisateur($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->contains($evenement)) {
            $this->evenements->removeElement($evenement);
            // set the owning side to null (unless already changed)
            if ($evenement->getUtilisateur() === $this) {
                $evenement->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setUtilisateur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getUtilisateur() === $this) {
                $produit->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Album[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->contains($album)) {
            $this->albums->removeElement($album);
            // set the owning side to null (unless already changed)
            if ($album->getUtilisateur() === $this) {
                $album->setUtilisateur(null);
            }
        }

        return $this;
    }

   

    

    /**
     * @return Collection|Aime[]
     */
    public function getAimes(): Collection
    {
        return $this->aimes;
    }

    public function addAime(Aime $aime): self
    {
        if (!$this->aimes->contains($aime)) {
            $this->aimes[] = $aime;
            $aime->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAime(Aime $aime): self
    {
        if ($this->aimes->contains($aime)) {
            $this->aimes->removeElement($aime);
            // set the owning side to null (unless already changed)
            if ($aime->getUtilisateur() === $this) {
                $aime->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Suivre[]
     */
    public function getSuivis(): Collection
    {
        return $this->suivis;
    }

    public function addSuivi(Suivre $suivre): self
    {
        if (!$this->suivis->contains($suivre)) {
            $this->suivis[] = $suivre;
            $suivre->setUtilisateurFrom($this);
        }

        return $this;
    }

    public function removeSuivi(Suivre $suivre): self
    {
        if ($this->suivis->contains($suivre)) {
            $this->suivis->removeElement($suivre);
            // set the owning side to null (unless already changed)
            if ($suivre->getUtilisateurFrom() === $this) {
                $suivre->setUtilisateurFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Suivre[]
     */
    public function getSuiveurs(): Collection
    {
        return $this->suiveurs;
    }

    public function addSuiveur(Suivre $suivre): self
    {
        if (!$this->suiveurs->contains($suivre)) {
            $this->suiveurs[] = $suivre;
            $suivre->setUtilisateurTo($this);
        }

        return $this;
    }

    public function removeSuiveur(Suivre $suivre): self
    {
        if ($this->suiveurs->contains($suivre)) {
            $this->suiveurs->removeElement($suivre);
            // set the owning side to null (unless already changed)
            if ($suivre->getUtilisateurTo() === $this) {
                $suivre->setUtilisateurTo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getUtilisateur() === $this) {
                $commentaire->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {

    }
/** @see \Serializable::serialize() */
public function serialize()
{
    return serialize(array(
        $this->id,
        $this->email,
        $this->password,
        // see section on salt below
        // $this->salt,
    ));
}

/** @see \Serializable::unserialize() */
public function unserialize($serialized)
{
    list (
        $this->id,
        $this->email,
        $this->password,
        // see section on salt below
        // $this->salt
    ) = unserialize($serialized);
}

public function getUsername(): string
    {
        return (string) $this->email;
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

    public function __toString()
    {
        return (string) $this->getPrenom(). ' '.$this->getNom();


    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setUtilisateur($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getUtilisateur() === $this) {
                $article->setUtilisateur(null);
            }
        }

        return $this;
    }

}
