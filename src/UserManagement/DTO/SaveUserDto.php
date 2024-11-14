<?php
namespace App\UserManagement\DTO;

class SaveUserDto
{
    private string $name;
    private string $role;
    private int $companyId;


    public function getName(): string
    {
        return $this->name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function __construct(string $name, string $role, int $companyId)
    {
        $this->name = $name;
        $this->role = $role;
        $this->companyId = $companyId;
    }
}
