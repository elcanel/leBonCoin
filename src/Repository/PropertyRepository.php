<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }
    /**
     * @return Property[]
     */
    public function findAllVisible() : array{
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

    }
    /**
     * @return Property[]
     */
    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }



    private function findVisibleQuery ()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = false');
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */



    public function findAllVisibleQuery (PropertySearch $search)
    {
        $query = $this->findVisibleQuery();

        //dd($query);

        if($search->getMaxPrice()){
            $query = $query
                ->andWhere('p.prix <= :maxPrice')
                ->setParameter('maxPrice', $search->getMaxPrice());
        }


        //dd($search);

        if($search->getCategorie()) {
            $query = $query
                ->andWhere('p.cat = :cat')
                ->setParameter('cat', $search->getCategorie());

        }





        return $query->getQuery()->getResult();
    }

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findBySold($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByUser($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id_user = :val')
            ->setParameter('val', $value)
            ->orderBy('p.title', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }


    public function findOneByUser($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }


    public function findAllAnimals (PropertySearch $search, $query)
    {

    }
}
