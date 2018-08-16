<?php

namespace App\Repository;

use App\Entity\Follower;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Follower|null find($id, $lockMode = null, $lockVersion = null)
 * @method Follower|null findOneBy(array $criteria, array $orderBy = null)
 * @method Follower[]    findAll()
 * @method Follower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FollowerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Follower::class);
    }

    public function ifFollowingExists($follower, $followed)
    {
        return $this->createQueryBuilder('f')
            ->select('COUNT(f)')
            ->where('f.follower = :val')
            ->setParameter('val', $follower)
            ->andWhere('f.followed = :val2')
            ->setParameter('val2', $followed)
            ->getQuery()
            ->getSingleScalarResult();
    }


    public function followingRelation($follower, $followed)
    {
        return $this->createQueryBuilder('f')
            ->select('f')
            ->where('f.follower = :val')
            ->setParameter('val', $follower)
            ->andWhere('f.followed = :val2')
            ->setParameter('val2', $followed)
            ->getQuery()
            ->getSingleResult();
    }

    public function relationExists($follower, $followed)
    {
        return $this->createQueryBuilder('f')
            ->select('f')
            ->where('f.follower = :val')
            ->setParameter('val', $follower)
            ->andWhere('f.followed = :val2')
            ->setParameter('val2', $followed)
            ->getQuery()
            ->getResult();
    }

    public function getRelation($star)
    {
        return $this->createQueryBuilder('f')
            ->select('f', 'u')
            /*->where('f.followed = :val1')
            ->setParameter('val1', $star)*/
            ->leftJoin('f.followed', 'u')
            ->andWhere('u.id = :val')
            ->setParameter('val', $star)
            ->getQuery()
            ->getResult();

    }

//    /**
//     * @return Follower[] Returns an array of Follower objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Follower
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
