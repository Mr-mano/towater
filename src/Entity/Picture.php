<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 * @Vich\Uploadable()
 */
class Picture
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
    private $photo;

    /**
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="photo")
     * @var File
     * @Assert\Image(mimeTypes={ "image/jpeg", "image/jpg", "image/png"  }, mimeTypesMessage = "Extension valide : .jpeg .png .jpg", groups = {"create"})
     */
    private $photoFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
    /**
     * @return null|File
     */
    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    /**
     * @param null|File $photoFile
     * @return self
     */
    public function setPhotoFile(File $photoFile): self
    {
        $this->photoFile = $photoFile;
        return $this;
    }

}
