<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KnowledgeRepository")
 *  @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"category"}}
 * )
 */
class Knowledge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"category"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"category"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @Groups({"category"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Groups({"category"})
     */
    private $imgUrl;

    /**
     * @ORM\Column(type="string", length=800, nullable=true)
     * @Groups({"category"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Groups({"category"})
     */
    private $extLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(?string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;

        return $this;
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

    public function getExtLink(): ?string
    {
        return $this->extLink;
    }

    public function setExtLink(?string $extLink): self
    {
        $this->extLink = $extLink;

        return $this;
    }
}
