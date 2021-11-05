<?php

namespace App\Repository;

use App\Entity\ContactUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactUser[]    findAll()
 * @method ContactUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactUser::class);
    }

    // /**
    //  * @return ContactUser[] Returns an array of ContactUser objects
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
    public function findOneBySomeField($value): ?ContactUser
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
