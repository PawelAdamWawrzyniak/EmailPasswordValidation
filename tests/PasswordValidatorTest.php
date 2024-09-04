<?php

namespace Tests;

use App\PasswordValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{

    #[DataProvider('ValidationDefaultPasswordDataProvider')]
    public function testValidateDefaultPassword(string $password, bool $expected): void
    {
        // Given
        $validator = new PasswordValidator($password);

        // When
        $result = $validator->validate();

        //Then
        $this->assertSame($expected, $result);
    }

    public static function ValidationDefaultPasswordDataProvider(): iterable
    {
        yield 'valid default password' => [
            'password' => '4234832313',
            'expected' => true,
        ];

        yield 'invalid default password' => [
            'password' => '423423',
            'expected' => false,
        ];
    }

    #[DataProvider('ValidationDefaultLengthPasswordDataProvider')]
    public function testValidateDefaultLengthPassword(string $password, bool $expected): void
    {
        // Given
        $validator = new PasswordValidator($password);

        // When
        $result = $validator->length()->validate();

        //Then
        $this->assertSame($expected, $result);
    }

    #[DataProvider('ValidationLengthPasswordDataProvider')]
    public function testValidateLengthPassword(string $password, int $length, bool $expected): void
    {
        // Given
        $validator = new PasswordValidator($password);

        // When
        $result = $validator->length($length)->validate();

        //Then
        $this->assertSame($expected, $result);
    }

    #[DataProvider('ValidationUpperCasePasswordDataProvider')]
    public function testValidateUpperCasePassword(string $password, bool $expected): void
    {
        // Given
        $validator = new PasswordValidator($password);

        // When
        $result = $validator->uppercase()->validate();

        //Then
        $this->assertSame($expected, $result);
    }

    #[DataProvider('ValidationLowerCasePasswordDataProvider')]
    public function testValidateLowerCasePassword(string $password, bool $expected): void
    {
        // Given
        $validator = new PasswordValidator($password);

        // When
        $result = $validator->lowercase()->validate();

        //Then
        $this->assertSame($expected, $result);
    }

    #[DataProvider('ValidationNumbersPasswordDataProvider')]
    public function testValidateNumbersPassword(string $password, bool $expected): void
    {
        // Given
        $validator = new PasswordValidator($password);

        // When
        $result = $validator->numbers()->validate();

        //Then
        $this->assertSame($expected, $result);
    }

    #[DataProvider('ValidationSpecialCharactersPasswordDataProvider')]
    public function testValidateSpecialCharactersPassword(string $password, bool $expected): void
    {
        // Given
        $validator = new PasswordValidator($password);

        // When
        $result = $validator->specialCharacters()->validate();

        //Then
        $this->assertSame($expected, $result);
    }

    public static function ValidationDefaultLengthPasswordDataProvider(): iterable
    {
        yield 'valid default length password' => [
            'password' => '12345678',
            'expected' => true,
        ];

        yield 'invalid default length password' => [
            'password' => '1234567',
            'expected' => false,
        ];
    }


    public static function ValidationLengthPasswordDataProvider(): iterable
    {
        yield 'invalid default password' => [
            'password' => '12345',
            'length' => 6,
            'expected' => false,
        ];

        yield 'valid default password' => [
            'password' => '123456',
            'length' => 6,
            'expected' => true,
        ];

        yield 'valid password, length 9' => [
            'password' => '123456789',
            'length' => 9,
            'expected' => true,
        ];

        yield 'valid password, length 10' => [
            'password' => '1234567890',
            'length' => 9,
            'expected' => true,
        ];
    }

    public static function ValidationUpperCasePasswordDataProvider(): iterable
    {
        yield 'valid password with uppercase' => [
            'password' => '12U345678',
            'expected' => true,
        ];

        yield 'invalid password with uppercase' => [
            'password' => '1234567',
            'expected' => false,
        ];
    }

    public static function ValidationLowerCasePasswordDataProvider(): iterable
    {
        yield 'valid password with lowercase' => [
            'password' => '12j345678',
            'expected' => true,
        ];

        yield 'invalid password with lowercase' => [
            'password' => '1234567',
            'expected' => false,
        ];
    }

    public static function ValidationNumbersPasswordDataProvider(): iterable
    {
        yield 'valid password with numbers' => [
            'password' => 'dafasf1234567',
            'expected' => true,
        ];

        yield 'invalid password with numbers' => [
            'password' => 'fafaf',
            'expected' => false,
        ];
    }

    public static function ValidationSpecialCharactersPasswordDataProvider(): iterable
    {
        yield 'valid password with special characters' => [
            'password' => 'dafasf1$67',
            'expected' => true,
        ];

        yield 'invalid password with special characters' => [
            'password' => 'fafaf',
            'expected' => false,
        ];
    }
}
