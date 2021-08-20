<?php

namespace App\Repository;

use App\Entity\ClientCreditCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientCreditCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientCreditCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientCreditCard[]    findAll()
 * @method ClientCreditCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientCreditCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientCreditCard::class);
    }

    // /**
    //  * @return ClientCreditCard[] Returns an array of ClientCreditCard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClientCreditCard
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
