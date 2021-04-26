<?php

namespace App\Services;

class FormValidation
{
    
    protected array $errors = [];

    public function sentenceEmpty(string $sentences, string $messageError): bool
    {
        if (empty($sentences)) {
            $this->setErrors($messageError);
            return true;
        } else {
            return false;
        }
    }

    public function wordIsInArray(string $word, array $array, string $message): void
    {
        if (!in_array($word, $array)) {
            $this->setErrors($message);
        }
    }

    public function emailValidate(string $email): void
    {
        if (!$this->sentenceEmpty($email, 'Un email est obligatoire')) {
            $this->emailFilterValidate($email, 'L\'email saisi n\'est pas valable');
        }
    }

    public function emailFilterValidate(string $sentence, string $messageError): void
    {
        if (!filter_var($sentence, FILTER_VALIDATE_EMAIL)) {
            $this->setErrors($messageError);
        }
    }

    public function wordMaxSize(string $word, int $length, string $messageError): void
    {
        if (strlen($word) > $length) {
            $this->setErrors($messageError);
        }
    }

    public function wordMinSize(string $word, int $length, string $messageError): void
    {
        if (strlen($word) < $length) {
            $this->setErrors($messageError);
        }
    }

    private function setErrors(string $errors): void
    {
        $this->errors[] = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isNotErrors(): bool
    {
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function displayErrorsHtml(): string
    {
        $html = '<ul>';
        foreach ($this->getErrors() as $error) {
            $html .= '<li>' . $error . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}
