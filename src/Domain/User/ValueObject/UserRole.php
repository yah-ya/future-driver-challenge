<?php

namespace App\Domain\User\ValueObject;

final class UserRole
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_COMPANY_ADMIN = 'ROLE_COMPANY_ADMIN';
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function user(): self
    {
        return new self(self::ROLE_USER);
    }

    public static function companyAdmin(): self
    {
        return new self(self::ROLE_COMPANY_ADMIN);
    }

    public static function superAdmin(): self
    {
        return new self(self::ROLE_SUPER_ADMIN);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function fromString(string $value): self
    {
        if (!in_array($value, [self::ROLE_USER, self::ROLE_COMPANY_ADMIN, self::ROLE_SUPER_ADMIN], true)) {
            throw new \InvalidArgumentException("Invalid role: $value");
        }

        return new self($value);
    }

    public function equals(UserRole $role): bool
    {
        return $this->value === $role->getValue();
    }
}

