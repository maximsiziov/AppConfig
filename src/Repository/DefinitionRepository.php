<?php

namespace App\Repository;

use App\Entity\Asset;
use App\Entity\Definition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Definition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Definition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Definition[]    findAll()
 * @method Definition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefinitionRepository extends ServiceEntityRepository implements SemVerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Definition::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findMajorVersion($version,$platform)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.majorVersion = :ver')
            ->andWhere('d.platform = :plat')
            ->setParameter('ver', $version)
            ->setParameter('plat', $platform)
            ->orderBy('d.minorVersion, d.patchVersion', 'DESC')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findMajorMinorVersion($major, $minor, $platform)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.majorVersion = :major')
            ->andWhere('d.minorVersion = :minor')
            ->andWhere('d.platform = :plat')
            ->setParameter('major', $major)
            ->setParameter('minor', $minor)
            ->setParameter('plat', $platform)
            ->orderBy(' d.patchVersion', 'DESC')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}