<?php

namespace App\Controller;

use App\Service\FormValidation;

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



    public const MAX_LENGTH_NAME = 255;
    public const MAX_LENGTH_EMAIL = 320;

    public function index(): string
    {
        $validation = new FormValidation();
        $subjects = ['tel-session', 'cabinet-session', 'infos', 'other'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $validation->sentenceEmpty($data['name'], 'Un nom complet est obligatoire');
            $validation->sentenceEmpty($data['tel'], 'Un numéro de téléphone est obligatoire');
            $validation->sentenceEmpty($data['message'], 'Un message est obligatoire');
            $validation->sentenceEmpty($data['email'], 'Un email est obligatoire');

            $validation->wordMaxSize($data['name'], self::MAX_LENGTH_NAME, 'Le nom complet doit faire moins de '
                . self::MAX_LENGTH_NAME . ' caractères');
            $validation->wordMaxSize($data['email'], self::MAX_LENGTH_EMAIL, 'L\'adresse mail doit faire moins de '
                . self::MAX_LENGTH_EMAIL . ' caractères');

            $validation->wordIsInArray($data['subject'], $subjects, 'Le sujet saisi n\'est pas valable');
            $validation->emailFilterValidate($data['email'], 'L\'email saisi n\'est pas valable');

            if (empty($validation->getErrors())) {
                    $message = 'Vous avez reçu un nouveau message de la part de ' . $data['name'] .
                    ', vous pouvez le joindre à ce numéro : ' . $data['tel'] . ' ou part mail : ' . $data['email'] .
                     'Son message est : ' . $data['message'];
                    mail("projetvoyance@gmail.com", $data['subject'], $message);
                return $this->twig->render('Visitor/Contact/success.html.twig');
            }
        }

        return $this->twig->render('Visitor/Contact/contact.html.twig', ['errors' => $validation->getErrors()]);
    }
}
