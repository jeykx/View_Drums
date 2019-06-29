<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DrumRepository")
 * @UniqueEntity("title")
 * @Vich\Uploadable()
 */
class Drum
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var string|null
     * @Orm\Column(type="string", length=255)
     */
    private $filename;
    
    /**
     * @var File null
     * @Assert\Image(
     *         mimeTypes="image/jpeg")
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=16, max=28)
     */
    private $dimension_gc;

    /**
     * @ORM\Column(type="integer")
     */
    private $futs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $woodtype;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bandname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $link_band;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $saledrumkit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $musicalstyle;

    public function __construct() {

        $this->created_at = New\DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): string 
    {
        return (new Slugify())->slugify($this->title);

    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDimensionGc(): ?int
    {
        return $this->dimension_gc;
    }

    public function setDimensionGc(int $dimension_gc): self
    {
        $this->dimension_gc = $dimension_gc;

        return $this;
    }

    public function getFuts(): ?int
    {
        return $this->futs;
    }

    public function setFuts(int $futs): self
    {
        $this->futs = $futs;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->price, 0, '', ' ');
    }

    public function getWoodtype(): ?string
    {
        return $this->woodtype;
    }

    public function setWoodtype(?string $woodtype): self
    {
        $this->woodtype = $woodtype;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }
    /**
     * @param null|string $filename
     * @return Drum
     */
    public function setFilename(?string $filename)
    {
        $this->filename = $filename;
    }
    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    /**
     * @param null|File $imageFile
     * @return Drum
     */
    public function setImageFile(?File $imageFile): Drum
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getBandname(): ?string
    {
        return $this->bandname;
    }

    public function setBandname(?string $bandname): self
    {
        $this->bandname = $bandname;

        return $this;
    }

    public function getLinkBand(): ?string
    {
        return $this->link_band;
    }

    public function setLinkBand(?string $link_band): self
    {
        $this->link_band = $link_band;

        return $this;
    }

    public function getSaledrumkit(): ?string
    {
        return $this->saledrumkit;
    }

    public function setSaledrumkit(?string $saledrumkit): self
    {
        $this->saledrumkit = $saledrumkit;

        return $this;
    }

    public function getMusicalstyle(): ?string
    {
        return $this->musicalstyle;
    }

    public function setMusicalstyle(?string $musicalstyle): self
    {
        $this->musicalstyle = $musicalstyle;

        return $this;
    }
}
