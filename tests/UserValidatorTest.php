<?php


namespace Tests;

use PHPUnit\Framework\TestCase;
use App\UserValidator;

class UserValidatorTest extends TestCase
{
    public function testValidateEmail(): void
    {
        // Given
        $validator = new UserValidator();

        // When
        $result = $validator->validateEmail('pawel_test_email.com');
        // Then

        $this->assertSame(false,$result);
    }
}
