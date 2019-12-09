<?php

namespace App\Repository;

use App\Entity\Multimedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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


    public function findBySearch(Multimedia $multi)
    {
        $query = $this->findAllQuery();


        //dd($query);

        if($multi->getType()) {
            $query = $query
                ->andWhere('a.type = :type')
                ->setParameter('type', $multi->getType());

        }
        //dd($multi);


        return $query->getQuery()->getResult();

    }
}
