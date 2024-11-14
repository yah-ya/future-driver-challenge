<?php

namespace App\UserManagement\Repository;

use App\Infrastructure\Repository\BaseRepositoryInterface;
use App\UserManagement\DTO\SaveUserDto;
use App\UserManagement\Entity\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find all users within a given company.
     *
     * @param int $companyId
     * @return User[]
     */
    public function findByCompanyId(int $companyId): array;

    /**
     * Find all users with a specific role.
     *
     * @param string $role
     * @return User[]
     */
    public function findByRole(string $role): array;

    /**
     * Save an entity to the data storage.
     *
     * @param SaveUserDto $userDto
     * @return User
     */
    public function save(SaveUserDto $userDto): User;
}
