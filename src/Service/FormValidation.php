<?php

namespace App\Service;

class FormValidation
{
    private array $errors = [];

    public function sentenceEmpty(string $sentences, string $messageError): bool
    {
        if (empty($sentences)) {
            $this->addError($messageError);
            return true;
        } else {
            return false;
        }
    }

    public function wordIsInArray(string $word, array $array, string $message): void
    {
        if (!in_array($word, $array)) {
            $this->addError($message);
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
            $this->addError($messageError);
        }
    }

    public function wordMaxSize(string $word, int $length, string $messageError): void
    {
        if (strlen($word) > $length) {
            $this->addError($messageError);
        }
    }

    public function wordMinSize(string $word, int $length, string $messageError): void
    {
        if (strlen($word) < $length) {
            $this->addError($messageError);
        }
    }

    public function phoneNumberValidate(string $phone, string $messageError): void
    {
        if (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
            $this->addError($messageError);
        }
    }

    private function addError(string $errors): void
    {
        $this->errors[] = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
