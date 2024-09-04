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
        $matches = $this->matchEmailRegex(self::EmailRegex, $email, $matches);

        return $this->isUserNameMatched($matches) && $this->isDomainMatched($matches);
    }

    /**
     * @param array $matches
     * @return bool
     */
    public function isUserNameMatched(array $matches): bool
    {
        return array_key_exists(self::USERNAME, $matches);
    }

    /**
     * @param array $matches
     * @return bool
     */
    public function isDomainMatched(array $matches): bool
    {
        return array_key_exists(self::DOMAIN, $matches);
    }

    /**
     * @param string $EmailRegexExpression
     * @param string $email
     * @param $matches
     * @return mixed
     */
    public function matchEmailRegex(string $EmailRegexExpression, string $email, $matches): mixed
    {
        preg_match($EmailRegexExpression, $email, $matches);
        return $matches;
    }
}