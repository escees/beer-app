<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("all")
 */
class Beer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=60)
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brewer", inversedBy="beers", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     * @Serializer\Type("App\Entity\Brewer")
     */
    private $brewer;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     */
    private $pricePerLitre;

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

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getBrewer(): Brewer
    {
        return $this->brewer;
    }

    public function setBrewer(Brewer $brewer): void
    {
        $this->brewer = $brewer;
    }

    public function getPricePerLitre(): int
    {
        return $this->pricePerLitre;
    }

    public function setPricePerLitre(int $pricePerLitre): void
    {
        $this->pricePerLitre = $pricePerLitre;
    }
}
