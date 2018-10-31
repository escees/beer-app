<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Brewer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Brewer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brewer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brewer[]    findAll()
 * @method Brewer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrewerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Brewer::class);
    }

    /**
     * @return Brewer[]
     */
    public function getAllBrewersWithDetails(): array
    {
        $queryBuilder = $this->createQueryBuilder('br');
        $queryBuilder->select('br.id');
        $queryBuilder->innerJoin('br.beers', 'be');
        $queryBuilder->addSelect('br.name');
        $queryBuilder->addSelect('COUNT(be) as beers_assigned');
        $queryBuilder->groupBy('br.id');

        return $queryBuilder
            ->getQuery()
            ->execute();
    }
}
