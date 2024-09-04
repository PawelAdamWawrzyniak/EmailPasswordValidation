# Email Password Validation

## Task description:

Create class in PHP 8.3 which will validate email and password.
Do not use any framework or library.

## Requirements:

### Class: UserValidator has 2 public methods:
 - `validateEmail(string $email): bool`
 - `validatePassword(string $password): bool`
 - both methods should return true if validation is successful, otherwise false
    
#### validateEmail(string $email): bool
   
- use Regex to validate email
 - valid Email Address:
   - email should contain @ 
   - email should have at least 1 letter before @
   - after @ should be domain with dot (e.g example.com) and with at least 2 letter after dot

#### validatePassword(string $password): bool

- password must have at least 8 characters
- password must have at least 1 uppercase letter
- password must have at least 1 lowercase letter
- password must have at least 1 number
- password must have at least 1 special character (e.g. !@#$%^&*)]

## Example of useage:

```php

$validator = new UserValidator();

$email = "test@example.com";
$password = "StrongPass1!";

if ($validator->validateEmail($email)) {
    echo "Email is valid.\n";
} else {
    echo "Email is invalid.\n";
}
if ($validator->validatePassword($password)) {
    echo "Password is valid.\n";
} else {
    echo "Password is invalid.\n";
}

```

## Assumptions/Concerns:
   - letter is any letter from a-z or A-Z.
   - character is any character from ASCII table.
   - no requirements characters before .
So I should assume that email test@.com is valid. In reality there is not such domain
   therefore there is no test for such cases. 
   - I should delegate validation of password to separate class if I want to cover solid principles.
   