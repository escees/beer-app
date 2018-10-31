<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Beer;
use App\Entity\Brewer;
use App\Entity\Product;
use App\Repository\BrewerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class BeerCreator
{
    private $entityManager;
    private $brewerRepository;

    public function __construct(EntityManagerInterface $entityManager, BrewerRepository $brewerRepository)
    {
        $this->entityManager = $entityManager;
        $this->brewerRepository = $brewerRepository;
    }

    public function createBeers($products): void
    {
        /** @var Product $product */
        foreach ($products as $product) {
            $beer = new Beer();
            $beer->setName($product->getName());
            $beer->setType($product->getType());
            $beer->setPrice($product->getPrice());
            $beer->setCountry($product->getCountry());
            $brewer = $this->getBrewerByName($product->getBrewer());
            if (!$brewer instanceof Brewer) {
                throw new \RuntimeException(
                    'There is no such kind of brewer in the database',
                    JsonResponse::HTTP_NOT_FOUND
                );
            }
            $beer->setBrewer($brewer);
            $brewer->addBeer($beer);

            $beer->setPricePerLitre(0); //@todo - use regexp for getting numbers from product size and count price per litre
            $this->entityManager->persist($beer);
        }

        $this->entityManager->flush();
    }

    public function getBrewerByName($brewerName): ?Brewer
    {
        return $this->brewerRepository->findOneBy(['name' => $brewerName]);
    }
}