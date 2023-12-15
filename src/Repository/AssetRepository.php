<?php

namespace App\Repository;

use App\Entity\Asset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asset|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asset|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asset[]    findAll()
 * @method Asset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetRepository extends ServiceEntityRepository implements SemVerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asset::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findMajorVersion($version, $platform)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.majorVersion = :ver')
            ->andWhere('a.platform = :plat')
            ->setParameter('ver', $version)
            ->setParameter('plat', $platform)
            ->orderBy('a.minorVersion, a.patchVersion', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findMajorMinorVersion($major, $minor, $platform)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.majorVersion = :major')
            ->andWhere('a.minorVersion = :minor')
            ->andWhere('a.platform = :plat')
            ->setParameter('major', $major)
            ->setParameter('minor', $minor)
            ->setParameter('plat', $platform)
            ->orderBy(' a.patchVersion', 'DESC')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}