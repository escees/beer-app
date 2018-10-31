<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Event\AppEvents;
use App\Event\DataImportSuccessEvent;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DataImporter
{
    private $entityManager;
    private $eventDispatcher;

    public function __construct(
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function import($data): bool
    {
        $serializer = SerializerBuilder::create()->build();
        $products = $serializer->deserialize($data, 'ArrayCollection<App\Entity\Product>', 'json' );

        /** @var Product $product */
        foreach ($products as $product) {
            $this->entityManager->persist($product);
        }

        $this->entityManager->flush();

        $this->eventDispatcher->dispatch(
            AppEvents::DATA_IMPORT_SUCCESSFUL,
            new DataImportSuccessEvent($products)
        );

        return true;
    }
}