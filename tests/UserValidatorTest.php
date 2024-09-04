<?php


namespace Tests;

use PHPUnit\Framework\TestCase;
use App\UserValidator;

class UserValidatorTest extends TestCase
{


    /**
     * @dataProvider dataProvider
     * @return void
     */
    public function testValidateEmail(string $email, bool $expected): void
    {
        // Given
        $validator = new UserValidator();

        // When
        $result = $validator->validateEmail($email);
        // Then

        $this->assertSame($expected,$result);
    }

    public static function dataProvider():iterable
    {
        yield 'email without @' => [
           'email' => 'pawel_test_email.com',
           'expected' => false,
        ];

        yield 'correct email' => [
            'email' => 'pawel@testemail.com',
            'expected' => true,
        ];
    }
}
