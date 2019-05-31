<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Article
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien_youtube;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Album", inversedBy="articles")
     * @ORM\JoinColumn(nullable=true)
     */
    private $album;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aime", mappedBy="article")
     */
    private $aimes;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="article")
     */
    private $commentaires;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;
    /**
     * @ORM\Column(type="boolean")
     */
    private $no_kill;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="article", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;

    /**
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="photo")
     * @var File
     * @Assert\Image(mimeTypes={ "image/jpeg", "image/jpg", "image/png"  }, mimeTypesMessage = "Extension valide : .jpeg .png .jpg", groups = {"create"})
     */
    private $pictureFiles;


    public function __construct()
    {

        $this->aimes = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }
    /**
     * @return mixed
     */
    public function getNoKill()
    {
        return $this->no_kill;
    }
    /**
     * @param mixed $no_kill
     */
    public function setNoKill($no_kill): void
    {
        $this->no_kill = $no_kill;
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

    public function getLienYoutube(): ?string
    {
        return $this->lien_youtube;
    }
    public function setLienYoutube(?string $lien_youtube): self
    {
        $this->lien_youtube = $lien_youtube;
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
    public function getAlbum(): ?Album
    {
        return $this->album;
    }
    public function setAlbum(?Album $album): self
    {
        $this->album = $album;
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
            $aime->setArticle($this);
        }
        return $this;
    }
    public function removeAime(Aime $aime): self
    {
        if ($this->aimes->contains($aime)) {
            $this->aimes->removeElement($aime);
            // set the owning side to null (unless already changed)
            if ($aime->getArticle() === $this) {
                $aime->setArticle(null);
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
            $commentaire->setArticle($this);
            $this->date_creation = new \DateTime('now');
        }
        return $this;
    }
    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticle() === $this) {
                $commentaire->setArticle(null);
            }
        }
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->date_creation = new \DateTime();
    }
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->date_maj = new \DateTime();
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
    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getLibelle();
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setArticle($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getArticle() === $this) {
                $picture->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictureFiles()
    {
        return $this->pictureFiles;
    }
    /**
     * @param mixed $pictureFiles
     * @return Article
     */
    public function setPictureFiles($pictureFiles): self
    {
        foreach($pictureFiles as $pictureFile) {
            $picture = new Picture();
            $picture->setPhotoFile($pictureFile);
            $this->addPicture($picture);
        }
        $this->pictureFiles = $pictureFiles;
        return $this;
    }


}