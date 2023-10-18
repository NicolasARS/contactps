<?php

namespace App\Repository;

use App\Entity\Contactos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contactos>
 *
 * @method Contactos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contactos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contactos[]    findAll()
 * @method Contactos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contactos::class);
    }

    public function findByName($text): array
    {
        $qb = $this->createQueryBuilder('c')
        ->andWHere('c.nombre lIKE :text')
        ->setParameter('text', '%' . $text . '%')
        ->getQuery();
        return $qb->execute();
    }


//    /**
//     * @return Contactos[] Returns an array of Contactos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Contactos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
