<?php

namespace App\Repository;

use App\Entity\Multimedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\PropertySearch;

/**
 * @method Multimedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Multimedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Multimedia[]    findAll()
 * @method Multimedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MultimediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Multimedia::class);
    }

    // /**
    //  * @return Multimedia[] Returns an array of Multimedia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Multimedia
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findBySearch(PropertySearch $search, $property)
    {


        $query = $this->createQueryBuilder('i')
            ->andWhere('i.property IN (:property)')
            ->setParameter('property', $property);
        //dd($query);





        if ($search->getTypeMulti()) {
            $query = $query
                ->andWhere('m.type = :type')
                ->setParameter('type', $search->getTypeMulti());
        }
        if ($search->getMarqueMulti()) {
            $query = $query
                ->andWhere('m.marque = :marque')
                ->setParameter('marque', $search->getMarqueMulti());
        }



        return $query->getQuery()->getResult();

    }
}
