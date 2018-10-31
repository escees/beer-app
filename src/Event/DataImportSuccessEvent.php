<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Product;
use Symfony\Component\EventDispatcher\Event;

class DataImportSuccessEvent extends Event
{
    /**
     * @var Product[]
     */
    private $beers;

    public function __construct(array $beers)
    {
        $this->beers = $beers;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->beers;
    }
}