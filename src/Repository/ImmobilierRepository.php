<?php

namespace App\Repository;

use App\Entity\Immobilier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\PropertySearch;

/**
 * @method Immobilier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Immobilier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Immobilier[]    findAll()
 * @method Immobilier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImmobilierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Immobilier::class);
    }

    // /**
    //  * @return Immobilier[] Returns an array of Immobilier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Immobilier
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
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



        if ($search->getTypeImmo()) {
            $query = $query
                ->andWhere('i.type = :type')
                ->setParameter('type', $search->getTypeImmo());
        }

        if ($search->getSurfaceImmo()) {
            $query = $query
                ->andWhere('i.surface = :surface')
                ->setParameter('surface', $search->getSurfaceImmo());
        }

        if ($search->getNbPieceImmo()) {
            $query = $query
                ->andWhere('i.nb_piece = :nb_piece')
                ->setParameter('nb_piece', $search->getNbPieceImmo());
        }



        return $query->getQuery()->getResult();

    }
}
