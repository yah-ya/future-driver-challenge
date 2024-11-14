<?php
namespace App\UserManagement\Repository;

use App\CompanyManagement\Entity\Company;
use App\Infrastructure\Repository\BaseRepository;
use App\UserManagement\DTO\SaveUserDto;
use App\UserManagement\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

class UserRepository extends BaseRepository Implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em, Security $security)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Find a user by role
     *
     * @param string $role
     * @return User[]
     */
    public function findByRole(string $role): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.role = :role')
            ->setParameter('role', $role)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find a user by ID
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?object
    {
        return $this->find($id);
    }


    public function save(SaveUserDto $userDto): User
    {
        // Start by creating a new User entity
        $user = new User();
        $user->setName($userDto->getName());
        $user->setRole($userDto->getRole());

        if (in_array($userDto->getRole(), ['ROLE_USER', 'ROLE_COMPANY_ADMIN'])) {

            $company = $this->em->getRepository(Company::class)->find($userDto->getCompanyId());

            if (!$company) {
                throw new \InvalidArgumentException('Company not found');
            }

            $user->setCompany($company);
        }

        if ($userDto->getRole() === 'ROLE_SUPER_ADMIN') {
            $user->setCompany(null);
        }

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function deleteById(int $id): void
    {
        // TODO: Implement deleteById() method.
    }

    /**
     * Find users by company
     *
     * @param int $companyId
     * @return User[]
     */
    public function findByCompanyId(int $companyId): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.company = :companyId')
            ->setParameter('companyId', $companyId)
            ->getQuery()
            ->getResult();
    }
}
