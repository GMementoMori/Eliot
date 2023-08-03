<?php
namespace App\Service;

class Validator
{
    protected array $data;
    protected array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validateRequired(string $field): void
    {
        if (empty($this->data[$field])) {
            $this->addError($field, "$field is required");
        }
    }

    public function validateEmail(string $field): void
    {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "$field is not a valid email");
        }
    }

    public function errors(): array
    {
        return $this->errors;
    }

    protected function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }
}