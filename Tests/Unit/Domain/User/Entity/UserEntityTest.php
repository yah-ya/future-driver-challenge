<?php
namespace Tests\Unit\Domain\User\Entity;

use App\Domain\User\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserEntityTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()->getValidator();
    }

    public function testUserInitialization(): void
    {
        $user = new User('John Doe', 'ROLE_USER');
        $this->assertEquals('John Doe', $user->getName());
        $this->assertEquals('ROLE_USER', $user->getRole());
    }

    public function testUserNameValidationConstraints(): void
    {
        $user = new User('John Doe', 'ROLE_USER');
        $violations = $this->validator->validate($user);
        $this->assertCount(0, $violations);

        $user->setName('Jo');
        $violations = $this->validator->validate($user);
        $this->assertGreaterThan(0, count($violations));
        $this->assertStringContainsString('This value is too short', $violations[0]->getMessage());

        $user->setName('john doe');
        $violations = $this->validator->validate($user);
        $this->assertGreaterThan(0, count($violations));
        $this->assertStringContainsString('Name must contain at least one uppercase letter.', $violations[0]->getMessage());

        $user->setName('John123');
        $violations = $this->validator->validate($user);
        $this->assertGreaterThan(0, count($violations));
        $this->assertStringContainsString('Name must contain only letters and spaces.', $violations[0]->getMessage());
    }

    public function testSetAndGetRole(): void
    {
        $user = new User('John Doe', 'ROLE_USER');
        $this->assertEquals('ROLE_USER', $user->getRole());

        $user->setRole('ROLE_COMPANY_ADMIN');
        $this->assertEquals('ROLE_COMPANY_ADMIN', $user->getRole());
    }
}
