<?php
namespace App\UserManagement\Service;

use App\UserManagement\Repository\UserRepository;
use App\UserManagement\DTO\SaveUserDto;
use App\UserManagement\Entity\User;

class UserService
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(SaveUserDto $userDTO): User
    {
        return $this->userRepository->save($userDTO);
    }
}
