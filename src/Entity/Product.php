<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $size;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     */
    private $beerId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $category;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Type("float")
     */
    private $abv;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $style;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $attributes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $brewer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private $country;

    /**
     * @ORM\Column(type="boolean")
     * @Serializer\Type("string")
     */
    private $onSale;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getBeerId(): int
    {
        return $this->beerId;
    }

    public function setBeerId(int $beerId): void
    {
        $this->beerId = $beerId;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getAbv(): float
    {
        return $this->abv;
    }

    public function setAbv(float $abv): void
    {
        $this->abv = $abv;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function setStyle(string $style): void
    {
        $this->style = $style;
    }

    public function getAttributes(): string
    {
        return $this->attributes;
    }

    public function setAttributes(string $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getBrewer(): string
    {
        return $this->brewer;
    }

    public function setBrewer(string $brewer): void
    {
        $this->brewer = $brewer;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry($country): void
    {
        $this->country = $country;
    }

    public function getOnSale(): bool
    {
        return $this->onSale;
    }

    public function setOnSale(bool $onSale): void
    {
        $this->onSale = $onSale;
    }
}
