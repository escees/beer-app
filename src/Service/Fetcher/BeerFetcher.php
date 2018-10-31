<?php

declare(strict_types=1);

namespace App\Service\Fetcher;

use App\Entity\Beer;
use App\Repository\BeerRepository;

class BeerFetcher
{
    /**
     * @var BeerRepository
     */
    private $beerRepository;
    private $searchableFields = [
        'name' => 'b.name',
        'brewer_id' => 'bb.id',
        'price' => 'b.price',
        'country' => 'b.country',
        'type' => 'b.type',
    ];

    public function __construct(BeerRepository $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    /**
     * @param string $search
     * @param string $sort
     * @param string $order
     *
     * @return Beer[]
     */
    public function fetch(string $search, string $sort, string $order): array
    {
        return $this->beerRepository->findAll($search, $this->getSearchableField($sort), $order);
    }

    private function getSearchableField(string $search): string
    {
        if (array_key_exists($search, $this->searchableFields)) {
            return $this->searchableFields[$search];
        }
        throw new \UnexpectedValueException();
    }
}