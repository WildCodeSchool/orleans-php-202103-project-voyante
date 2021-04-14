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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = [];
            $maxLength = 255;

            if (empty($data['name'])) {
                $errors[] = 'Le prénom est obligatoire';
            } elseif ($data['name'] > $maxLength) {
                $errors = 'Le prénom doit faire moins de' . $maxLength . ' caractères';
            }

            if (empty($data['email'])) {
                $errors[] = 'L\'email est obligatoire';
            }
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Mauvais format d\'email';
            }
            if (empty($data['message'])) {
                $errors[] = 'Un message est obligatoire';
            }
            if (empty($errors)) {
                echo 'Tout à bien été rempli';
            }
        }

        return $this->twig->render('Contact/contact.html.twig');
    }
}
