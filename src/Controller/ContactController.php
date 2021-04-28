<?php

namespace App\Controller;

class ContactController extends AbstractController
{
     /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    private array $errors = [];
    public const MAX_LENGTH_NAME = 255;
    public const MAX_LENGTH_EMAIL = 320;

    public function index(): string
    {
        $subjects = ['tel-session', 'cabinet-session', 'infos', 'other'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $this->checkSentenceEmpty($data['name'], 'Un nom complet est obligatoire');
            $this->checkSentenceEmpty($data['tel'], 'Un numéro de téléphone est obligatoire');
            $this->checkSentenceEmpty($data['message'], 'Un message est obligatoire');
            $this->checkSentenceEmpty($data['email'], 'Un email est obligatoire');

            $this->checkWordSize($data['name'], self::MAX_LENGTH_NAME, 'Le nom complet doit faire moins de '
                . self::MAX_LENGTH_NAME . ' caractères');
            $this->checkWordSize($data['email'], self::MAX_LENGTH_EMAIL, 'L\'adresse mail doit faire moins de '
                . self::MAX_LENGTH_EMAIL . ' caractères');

            $this->checkWordPresenceInArray($data['subject'], $subjects, 'Le sujet saisi n\'est pas valable');
            $this->checkFilterValidateEmail($data['email'], 'L\'email saisi n\'est pas valable');

            if (empty($this->getErrors())) {
                return $this->twig->render('Visitor/Contact/success.html.twig');
            }
        }

        return $this->twig->render('Visitor/Contact/contact.html.twig', ['errors' => $this->getErrors()]);
    }

    private function checkWordPresenceInArray(string $word, array $array, string $message): void
    {
        if (!in_array($word, $array)) {
            $this->setErrors($message);
        }
    }

    private function checkWordSize(string $word, int $length, string $messageError): void
    {
        if (strlen($word) > $length) {
            $this->setErrors($messageError);
        }
    }

    private function checkFilterValidateEmail(string $sentence, string $messageError): void
    {
        if (!filter_var($sentence, FILTER_VALIDATE_EMAIL)) {
            $this->setErrors($messageError);
        }
    }

    private function checkSentenceEmpty(string $sentences, string $messageError): void
    {
        if (empty($sentences)) {
            $this->setErrors($messageError);
        }
    }

    private function setErrors(string $errors): void
    {
        $this->errors[] = $errors;
    }

    private function getErrors(): array
    {
        return $this->errors;
    }
}
