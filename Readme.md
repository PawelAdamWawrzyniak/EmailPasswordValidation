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
   - email should have at least 1 character before @
   - after @ should be domain with dot (e.g example.com) and with at least 2 characters after dot

#### validatePassword(string $password): bool

- password must have at least 8 characters
- password must have at least 1 uppercase letter
- password must have at least 1 lowercase letter
- password must have at least 1 number
- password must have at least 1 special character (e.g. !@#$%^&*)]