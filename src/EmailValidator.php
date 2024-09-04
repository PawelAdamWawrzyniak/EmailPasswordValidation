<?php

declare(strict_types=1);

namespace App;

class EmailValidator
{

    const string USERNAME = 'username';
    const string DOMAIN = 'domain';
    const string EmailRegex = '/(?P<' . self::USERNAME . '>[a-zA-Z]+)@(?P<' . self::DOMAIN . '>\w*\..*[a-zA-Z].*[a-zA-Z].*)/';

    public function validateEmail(string $email): bool
    {
        $matches = [];
        $matches = $this->matchEmailRegex($email, $matches);

        return $this->isUserNameMatched($matches) && $this->isDomainMatched($matches);
    }

    /**
     * @param array $matches
     * @return bool
     */
    private function isUserNameMatched(array $matches): bool
    {
        return array_key_exists(self::USERNAME, $matches);
    }

    /**
     * @param array $matches
     * @return bool
     */
    private function isDomainMatched(array $matches): bool
    {
        return array_key_exists(self::DOMAIN, $matches);
    }

    /**
     * @param string $email
     * @param $matches
     * @return mixed
     */
    private function matchEmailRegex(string $email, $matches): mixed
    {
        preg_match(self::EmailRegex, $email, $matches);
        return $matches;
    }
}