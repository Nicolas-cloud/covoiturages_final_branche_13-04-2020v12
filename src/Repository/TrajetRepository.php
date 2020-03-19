<?php

namespace App\Repository;

use App\Entity\Trajet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Trajet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trajet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trajet[]    findAll()
 * @method Trajet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrajetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trajet::class);
    }

    /**
    * @return Trajet[]
    */
    public function getTrajetsNonExpires()
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.date_expiration > :date')
            ->setParameter('date', new \DateTime())
            ->orderBy('t.date_creation', 'DESC');
        return $qb->getQuery()->getResult();
    }
    
    /**
    * @return Trajet[] Returns an array of Trajet objects
    */
    public function searchTrajet($criteria)
    {
        $qb = $this->createQueryBuilder('t')
            //->leftJoin('t.ville_depart', 'ville_depart')
            //->leftJoin('t.ville_arrivee', 'ville_arrivee')
            ->where('t.ville_depart = :ville_depart')
            ->setParameter("ville_depart", $criteria['ville_depart']) 
            ->andWhere('t.ville_arrivee = :ville_arrivee')
            ->setParameter("ville_arrivee", $criteria['ville_arrivee'])
            ->andWhere('t.nb_places >= :nb_places')
            ->setParameter("nb_places", $criteria['nb_places'])
            ->andWhere('t.prix >= :maximum_price')
            ->setParameter("maximum_price", $criteria['maximum_price'])
            ->orderBy('t.prix', 'ASC');


        return $qb->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Trajet
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
