<?php

declare(strict_types=1);

namespace App;

class UserValidator
{
    public function validateEmail(string $email): bool
    {
        preg_match('/(?P<username>[a-zA-Z]+)@(?P<domain>\w*\.[a-zA-Z]{2}.*)/', $email, $matches);

        return array_key_exists('username', $matches) && array_key_exists('domain', $matches);
    }

    public function  validatePassword(string $password): bool
    {
        return false;
    }
}