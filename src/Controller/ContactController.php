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

    public function index()
    {
        $subjects = ['tel-session', 'cabinet-session', 'infos', 'other'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            define('MAX_LENGTH_NAME', 255);
            define('MAX_LENGTH_EMAIL', 320);

            $this->checkSentenceEmpty($data['name'], 'Un nom complet est obligatoire');
            $this->checkSentenceEmpty($data['tel'], 'Veuillez renseigner votre numéro de téléphone');
            $this->checkSentenceEmpty($data['message'], 'Un message est obligatoire');
            $this->checkSentenceEmpty($data['email'], 'L\'email est obligatoire');

            $this->checkWordSize($data['name'], MAX_LENGTH_NAME, 'Le nom complet doit faire moins de '
                . MAX_LENGTH_NAME . ' caractères');
            $this->checkWordSize($data['email'], MAX_LENGTH_EMAIL, 'Votre adresse mail doit faire moins de '
                . MAX_LENGTH_EMAIL . ' caractères');

            $this->checkWordPresenceInArray($data['subject'], $subjects, 'Le sujet saisi n\'est pas valable');
            $this->checkFilterValidateEmail($data['email'], 'Mauvais format d\'email');

            if (empty($this->getErrors())) {
                return 'Votre message à bien été envoyé.';
            }
        }

        return $this->twig->render('Contact/contact.html.twig', ['errors' => $this->getErrors()]);
    }

    public function checkWordPresenceInArray(string $word, array $array, string $message)
    {
        if (!in_array($word, $array)) {
            $this->setErrors($message);
        }
    }

    public function checkWordSize(string $word, int $length, string $messageError)
    {
        if (strlen($word) > $length) {
            $this->setErrors($messageError);
        }
    }

    public function checkFilterValidateEmail(string $sentence, string $messageError)
    {
        if (!filter_var($sentence, FILTER_VALIDATE_EMAIL)) {
            $this->setErrors($messageError);
        }
    }

    public function checkSentenceEmpty(string $sentences, string $messageError)
    {
        if (empty($sentences)) {
            $this->setErrors($messageError);
        }
    }

    private function setErrors(string $errors)
    {
        $this->errors[] = $errors;
    }

    private function getErrors(): array
    {
        return $this->errors;
    }
}
