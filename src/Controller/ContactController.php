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
        //$subjects = ['Séance téléphonique', 'Séance au cabinet', 'Demande d\'informations', 'Autres'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            define('MAX_LENGTH_NAME', 255);
            define('MAX_LENGTH_EMAIL', 320);

            if (empty($data['name'])) {
                $errors[] = 'Un nom complet est obligatoire';
            }
            if (strlen($data['name']) > MAX_LENGTH_NAME) {
                $errors[] = 'Le nom complet doit faire moins de ' . MAX_LENGTH_NAME . ' caractères';
            }
           /* if (empty($data['email'])) {
                $errors[] = 'L\'email est obligatoire';
            } else {
                if (strlen($data['email']) > MAX_LENGTH_EMAIL) {
                $errors[] = 'Votre adresse mail doit faire moins de ' . MAX_LENGTH_EMAIL . ' caractères';
                }
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Mauvais format d\'email';
                }
                }*/
            if (empty($data['tel'])) {
                $errors[] = 'Veuillez renseigner votre numéro de téléphone';
            }
            if (!in_array($data['subject'], $subjects)) {
                $errors[] = 'Le sujet saisie n\'est pas valable';
            }
            if (empty($data['message'])) {
                $errors[] = 'Un message est obligatoire';
            }
            if (empty($errors)) {
                echo 'Votre message à bien été envoyé.';
            }
        }

        return $this->twig->render('Contact/contact.html.twig', [
            'errors' => $errors
        ]);
    }
}
