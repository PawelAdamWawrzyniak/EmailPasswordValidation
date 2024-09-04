<?php

declare(strict_types=1);

namespace App;

use App\Enum\ValidationStatus;

class PasswordValidator
{
    private ValidationStatus $validated = ValidationStatus::NOT_SET;

    public function __construct(private readonly string $password)
    {
    }

    public function validate(): bool
    {
        if ($this->validated === ValidationStatus::NOT_SET) {
            $this->setDefaults();
        }
        return $this->validated === ValidationStatus::VALID;
    }

    public function length(int $length = 8): self
    {
        $this->updateValidationStatus($this->minLength($length));
        return $this;
    }

    public function uppercase(): self
    {
        $this->updateValidationStatus($this->hasUppercase());
        return $this;
    }

    public function lowercase(): self
    {
        $this->updateValidationStatus($this->hasLowercase());
        return $this;
    }

    public function number(): self
    {
        $this->updateValidationStatus($this->hasNumber());
        return $this;
    }

    private function minLength(int $minLength = 8): bool
    {
        return strlen($this->password) >= $minLength;
    }

    private function hasUppercase(): bool
    {
        return (bool)preg_match('/[A-Z]/', $this->password);
    }

    private function hasLowercase(): bool
    {
        return (bool)preg_match('/[a-z]/', $this->password);
    }

    private function hasNumber(): bool
    {
        return (bool)preg_match('/\d/', $this->password);
    }

    public function specialCharacter(): self
    {
        $this->updateValidationStatus($this->hasSpecialCharacter());
        return $this;
    }

    private function hasSpecialCharacter(): bool
    {
        return (bool)preg_match('/[^a-zA-Z\d]/', $this->password);
    }

    private function updateValidationStatus(bool $validationStatus): void
    {
        if ($this->validated === ValidationStatus::NOT_SET) {
            $this->validated = $validationStatus ? ValidationStatus::VALID : ValidationStatus::NOT_VALID;
        } else {
            $this->validated = !$validationStatus ? ValidationStatus::NOT_VALID : $this->validated;
        }
    }

    private function setDefaults(): void
    {
        $this->length();
    }
}