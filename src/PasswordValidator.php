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
        $this->updateValidationStatus(strlen($this->password) >= $length);
        return $this;
    }

    public function uppercase(): self
    {
        $this->updateValidationStatus((bool)preg_match('/\p{Lu}/u', $this->password));
        return $this;
    }

    public function lowercase(): self
    {
        $this->updateValidationStatus((bool)preg_match('/\p{Ll}/u', $this->password));
        return $this;
    }

    public function numbers(): self
    {
        $this->updateValidationStatus((bool)preg_match('/\p{Nd}/u', $this->password));
        return $this;
    }

    public function specialCharacters(): self
    {
        $this->updateValidationStatus((bool)preg_match('/[\p{S}\p{P}]/u', $this->password));
        return $this;
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