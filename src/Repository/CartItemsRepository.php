<?php

namespace App\Repository;

use App\Entity\CartItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CartItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartItems[] findAll()
 * @method CartItems[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItems::class);
    }
}
