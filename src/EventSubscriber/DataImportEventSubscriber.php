<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Brewer;
use App\Entity\Product;
use App\Event\AppEvents;
use App\Event\DataImportSuccessEvent;
use App\Service\BeerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DataImportEventSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    private $beerCreator;

    public function __construct(
        EntityManagerInterface $entityManager,
        BeerCreator $beerCreator
    )
    {
        $this->entityManager = $entityManager;
        $this->beerCreator = $beerCreator;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            AppEvents::DATA_IMPORT_SUCCESSFUL => 'onImportSuccess',
        ];
    }

    public function onImportSuccess(DataImportSuccessEvent $event): void
    {
        $products = $event->getProducts();

        $this->createBrewers($products);
    }

    /**
     * @param Product[] $products
     */
    private function createBrewers(array $products): void
    {
        /** @var Product $product */
        $brewerNames = [];
        foreach ($products as $product) {
            $brewerNames[] = $product->getBrewer();
        }

        $uniqueBrewerNames = array_unique($brewerNames);
        foreach ($uniqueBrewerNames as $uniqueBrewerName) {
            $brewer = new Brewer();
            $brewer->setName($uniqueBrewerName);

            $this->entityManager->persist($brewer);
        }

        $this->entityManager->flush();

        $this->beerCreator->createBeers($products);
    }
}