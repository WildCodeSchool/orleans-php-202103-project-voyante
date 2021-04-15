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

    public function index()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            define('MAX_LENGTH_NAME', 255);

            if (empty($data['name'])) {
                $errors[] = 'Un nom complet est obligatoire';
            } elseif ($data['name'] > MAX_LENGTH_NAME) {
                $errors[] = 'Un nom complet doit faire moins de ' . MAX_LENGTH_NAME . ' caractères';
            }
            if (empty($data['email'])) {
                $errors[] = 'L\'email est obligatoire';
            }
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Mauvais format d\'email';
            }
            if (empty($data['tel'])) {
                $errors[] = 'Veuillez renseigner votre numéro de téléphone';
            }
            if (empty($data['subject'])) {
                $errors[] = 'Veuillez renseigner le motif';
            }
            if (empty($data['message'])) {
                $errors[] = 'Un message est obligatoire';
            }
        }

        return $this->twig->render('Contact/contact.html.twig', [
            'errors' => $errors
        ]);
    }
}
