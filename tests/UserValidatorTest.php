<?php


namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use App\UserValidator;

class UserValidatorTest extends TestCase
{
    #[DataProvider('ValidationPasswordDataProvider')]
    public function testValidatePassword(string $password, bool $expected): void
    {
        // Given
        $validator = new UserValidator();

        // When
        $result = $validator->validatePassword($password);
        // Then

        $this->assertSame($expected,$result);
    }

    #[DataProvider('ValidationEmailDataProvider')]
    public function testValidateEmail(string $email, bool $expected): void
    {
        // Given
        $validator = new UserValidator();

        // When
        $result = $validator->validateEmail($email);
        // Then

        $this->assertSame($expected,$result);
    }

    public static function ValidationPasswordDataProvider(): iterable
    {
        yield 'correct password' => [
            'password' => 'Wl@12345',
            'expected' => true,
        ];

        yield 'password with less then 8 characters' => [
            'password' => 'Wl@145',
            'expected' => false,
        ];

        yield 'password without uppercase letter' => [
            'password' => 'wl@12345',
            'expected' => false,
        ];

        yield 'password without lowercase letter' => [
            'password' => 'WL@12345',
            'expected' => false,
        ];

        yield 'password without number' => [
            'password' => 'WL@abcde',
            'expected' => false,
        ];

        yield 'password without special character' => [
            'password' => 'WL1abcde',
            'expected' => false,
        ];
    }


    public static function ValidationEmailDataProvider():iterable
    {
        yield 'correct email' => [
            'email' => 'pawel@testemail.com',
            'expected' => true,
        ];

        yield 'email without @' => [
           'email' => 'pawel_test_email.com',
           'expected' => false,
        ];

        yield 'email without letter before @' => [
            'email' => '@testemail.com',
            'expected' => false,
        ];

        yield 'email without domain - dot not found' => [
            'email' => 'test@testemailcom',
            'expected' => false,
        ];

        yield 'email no letter in name of domain' => [
            'email' => 'test@.com',
            'expected' => true,
        ];

        yield 'email other characters - no letter in domain after dot' => [
            'email' => 'test@example.5242@#4',
            'expected' => false,
        ];

        yield 'email other characters - one letter in domain after dot' => [
            'email' => 'test@example.52w42@#4',
            'expected' => false,
        ];

        yield 'email one letter in name of domain' => [
            'email' => 'testr@.com',
            'expected' => true,
        ];
    }
}
