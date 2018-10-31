<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Beer;
use Doctrine\ORM\EntityManagerInterface;

class BeerRepository
{
    /** @var EntityManagerInterface */
    private $entityManger;

    public function __construct(EntityManagerInterface $entityManger)
    {
        $this->entityManger = $entityManger;
    }

    public function find(int $id): ?Beer
    {
        return $this->entityManger->getRepository(Beer::class)->find($id);
    }

    /**
     * @param null|string $search
     * @param null|string $sort
     * @param null|string $order
     * @return Beer[]
     */
    public function findAll(?string $search, ?string $sort, ?string $order): array
    {
        $queryBuilder = $this->entityManger->createQueryBuilder();
        $queryBuilder->select('b');
        $queryBuilder->from(Beer::class, 'b');
        $queryBuilder->leftJoin('b.brewer', 'bb');

        if ($sort && $order) {
            $queryBuilder->orderBy($sort, $order);
        }
        if ($search) {
            $queryBuilder->andWhere($queryBuilder->expr()->orX(
                $queryBuilder->expr()->like('b.name', ':search'),
                $queryBuilder->expr()->like('bb.id', ':search'),
                $queryBuilder->expr()->like('b.price', ':search'), //todo should be between
                $queryBuilder->expr()->like('b.country', ':search'),
                $queryBuilder->expr()->like('b.type', ':search')
            ));
            $queryBuilder->setParameter('search', sprintf('%%%s%%', $search));
        }
        return $queryBuilder->getQuery()->execute();
    }
}
