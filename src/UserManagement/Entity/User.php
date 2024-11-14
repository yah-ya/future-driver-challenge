<?php

namespace App\UserManagement\Entity;

use ApiPlatform\State\ApiResource;
use App\CompanyManagement\Entity\Company;
use App\UserManagement\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get"={"security"="is_granted('ROLE_USER')"},
 *         "post"={"security"="is_granted('ROLE_COMPANY_ADMIN') or is_granted('ROLE_SUPER_ADMIN')"}
 *     },
 *     itemOperations={
 *         "get"={"security"="is_granted('ROLE_USER')"},
 *         "delete"={"security"="is_granted('ROLE_SUPER_ADMIN')"}
 *     }
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=100)
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z\s]+$/",
     *     message="Name must contain only letters and spaces."
     * )
     * @Assert\Regex(
     *     pattern="/[A-Z]/",
     *     message="Name must contain at least one uppercase letter."
     * )
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @Assert\NotBlank
     * @Assert\Choice(choices={"ROLE_USER", "ROLE_COMPANY_ADMIN", "ROLE_SUPER_ADMIN"})
     * @ORM\Column(type="string")
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="App\CompanyManagement\Entity\Company")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Company $company;

    public function __construct(string $name, string $role)
    {
        $this->name = $name;
        $this->role = $role;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): void
    {
        $this->company = $company;
    }
}
