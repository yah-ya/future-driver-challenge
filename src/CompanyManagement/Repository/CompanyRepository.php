<?php
namespace App\CompanyManagement\Repository;

use App\CompanyManagement\Entity\Company;
use App\Infrastructure\Repository\BaseRepository;
use Doctrine\Persistence\ManagerRegistry;

class CompanyRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }
    public function findOneByName(string $name): ?Company
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllCompanies(): array
    {
        return $this->findAll();
    }
}
