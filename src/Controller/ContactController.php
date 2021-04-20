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
        $subjects = ['Séance téléphonique', 'Séance au cabinet', 'Demande d\'informations', 'Autres'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            define('MAX_LENGTH_NAME', 255);

            if (empty($data['name'])) {
                $this->setErrors('Un nom complet est obligatoire');
            }
            if (strlen($data['name']) > MAX_LENGTH_NAME) {
                $this->setErrors('Le nom complet doit faire moins de ' . MAX_LENGTH_NAME . ' caractères');
            }
            if (empty($data['tel'])) {
                $this->setErrors('Veuillez renseigner votre numéro de téléphone');
            }
            if (!in_array($data['subject'], $subjects)) {
                $this->setErrors('Le sujet saisie n\'est pas valable');
            }
            if (empty($data['message'])) {
                $this->setErrors('Un message est obligatoire');
            }
            if (empty($this->getErrors())) {
                echo 'Votre message à bien été envoyé.';
            }

            $this->verifmail($data['email']);
        }

        return $this->twig->render('Contact/contact.html.twig', [
            'errors' => $this->getErrors()
        ]);
    }

    public function verifmail(string $strVerif)
    {
        define('MAX_LENGTH_EMAIL', 320);
        if (empty($strVerif)) {
            $this->setErrors('L\'email est obligatoire');
        } else {
            if (strlen($strVerif) > MAX_LENGTH_EMAIL) {
                $this->setErrors('Votre adresse mail doit faire moins de ' . MAX_LENGTH_EMAIL . ' caractères');
            }
            if (!filter_var($strVerif, FILTER_VALIDATE_EMAIL)) {
                $this->setErrors('Mauvais format d\'email');
            }
        }
    }

    public function setErrors(string $errors)
    {
        $this->errors[] = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
