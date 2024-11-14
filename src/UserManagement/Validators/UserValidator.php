<?php
// src/Validator/UserValidator.php

namespace App\UserManagement\Validators;

use App\UserManagement\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(User $user): void
    {
        $violations = $this->validator->validate($user);

        $nameConstraint = new Assert\Length(['min' => 3, 'max' => 100]);
        $nameViolations = $this->validator->validate($user->getName(), $nameConstraint);
        $violations->addAll($nameViolations);

        if (count($violations) > 0) {
            throw new \Symfony\Component\Validator\Exception\ValidatorException('Validation failed.');
        }
    }
}
