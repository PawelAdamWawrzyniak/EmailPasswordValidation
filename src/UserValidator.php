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
        return $this->minLength($password) && $this->hasUppercase($password)
            && $this->hasLowercase($password) && $this->hasNumber($password)
            && $this->hasSpecialCharacter($password);
    }

    private function minLength(string $password,int $minLength = 8): bool
    {
        return strlen($password) >= $minLength;
    }

    private function hasUppercase(string $password):bool
    {
        return (bool) preg_match('/[A-Z]/', $password);
    }

    private function hasLowercase(string $password): bool
    {
        return (bool) preg_match('/[a-z]/', $password);
    }

    private function hasNumber(string $password): bool
    {
        return (bool) preg_match('/\d/', $password);
    }

    private function hasSpecialCharacter(string $password): bool
    {
        return (bool) preg_match('/[^a-zA-Z\d]/', $password);
    }
}