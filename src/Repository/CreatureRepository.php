<?php

namespace App\Repository;

use App\Entity\Creature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Creature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creature[]    findAll()
 * @method Creature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Creature::class);
    }

    // /**
    //  * @return Creature[] Returns an array of Creature objects
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
    public function findOneBySomeField($value): ?Creature
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findById($id) : Creature
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function save(Creature $creature)
    {
        $this->_em->persist($creature);
        $this->_em->flush();
    }

    public function removeById($id)
    {
        $entity = $this->findById($id);
        if ($entity !== null)
        {
            $this->_em->remove($entity);
            $this->_em->flush();
        }
    }
}
