<?php

declare(strict_types=1);

namespace App;

class UserValidator
{
    private EmailValidator $emailValidator;

    public function __construct()
    {
        $this->emailValidator = new EmailValidator();
    }

    public function validateEmail(string $email): bool
    {
        return $this->emailValidator->validateEmail($email);
    }

    public function validatePassword(string $password): bool
    {
        $passwordValidator = new PasswordValidator($password);

        return $passwordValidator
            ->length()
            ->uppercase()
            ->lowercase()
            ->number()
            ->specialCharacter()
            ->validate();
    }
}