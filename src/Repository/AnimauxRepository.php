<?php

namespace App\Repository;

use App\Entity\Animaux;
use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\PropertySearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

/**
 * @method Animaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animaux[]    findAll()
 * @method Animaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animaux::class);
    }

    // /**
    //  * @return Animaux[] Returns an array of Animaux objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Animaux
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllQuery()
    {
        return $this->createQueryBuilder('a');
    }





    public function findBySearch(PropertySearch $search, $property)
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.property IN (:property)')
            ->setParameter('property', $property);

        //dd($search->getTypeAnim());

        if($search->getTypeAnim()) {
            $query = $query
                ->andWhere('a.type = :type')
                ->setParameter('type', $search->getTypeAnim());
        }
        //dd($search);


        return $query->getQuery()->getResult();

    }
}
