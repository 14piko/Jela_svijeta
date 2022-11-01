<?php

namespace App\Repository;

use App\Entity\Association;
use App\Entity\Food;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class FoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Food::class);
    }

    public function findAllFood()
    {
        return $this->createQueryBuilder('f')
            ->orderBy('f.name', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $input
     * @return QueryBuilder
     */
    public function search($input)
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.category','category')
            ->innerJoin('f.ingredients','ingredients')
            ->innerJoin('f.tags','tags')
            ->where('CONCAT(f.name,category.title,ingredients.title,tags.title) like :input')
            ->setParameter('input', '%' . $input . '%')
            ->orderBy('f.name');
    }
}
