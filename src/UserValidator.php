<?php

declare(strict_types=1);

namespace App;

class UserValidator
{
    public function validateEmail(string $email): bool
    {
        return false;
    }

    public function  validatePassword(string $password): bool
    {
        return false;
    }
}