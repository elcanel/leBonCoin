<?php

namespace App\Repository;

use App\Entity\Vehicules;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\PropertySearch;

/**
 * @method Vehicules|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicules|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicules[]    findAll()
 * @method Vehicules[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicules::class);
    }

    // /**
    //  * @return Vehicules[] Returns an array of Vehicules objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vehicules
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findBySearch(PropertySearch $search, $property)
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.property IN (:property)')
            ->setParameter('property', $property);



        if ($search->getTypeVehi()) {
            $query = $query
                ->andWhere('v.type = :type')
                ->setParameter('type', $search->getTypeVehi());
        }
        if ($search->getNbKmVehi()) {
            $query = $query
                ->andWhere('v.nb_km = :nb_km')
                ->setParameter('nb_km', $search->getNbKmVehi());
        }
        if ($search->getEnergieVehi()) {
            $query = $query
                ->andWhere('v.energie = :ene')
                ->setParameter('ene', $search->getEnergieVehi());
        }
        if ($search->getAnneeVehi()) {
            $query = $query
                ->andWhere('v.annee = :an')
                ->setParameter('an', $search->getAnneeVehi());
        }




        return $query->getQuery()->getResult();

    }
}
