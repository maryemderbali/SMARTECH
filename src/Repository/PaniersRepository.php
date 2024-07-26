<?php

namespace App\Repository;

use App\Entity\Paniers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paniers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paniers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paniers[] findAll()
 * @method Paniers[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaniersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paniers::class);
    }
}
