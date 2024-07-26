<?php

namespace App\Repository;

use App\Entity\Commandee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commandee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commandee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commandee[] findAll()
 * @method Commandee[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commandee::class);
    }
}
