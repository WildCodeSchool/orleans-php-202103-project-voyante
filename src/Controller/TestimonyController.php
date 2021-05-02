<?php

namespace App\Controller;

use App\Service\FormValidation;
use App\Model\TestimoniesManager;

class TestimonyController extends AbstractController
{
     /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */


    public array $errors = [];
    public const MAX_LENGTH_NAME = 255;
    public const MAX_LENGTH_EMAIL = 320;

    public function index(): string
    {
        $validation = new FormValidation();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $validation->sentenceEmpty($data['name'], 'Un nom complet est obligatoire');
            $validation->sentenceEmpty($data['message'], 'Un message est obligatoire');
            $validation->sentenceEmpty($data['mail'], 'Un email est obligatoire');

            $validation->wordMaxSize($data['name'], self::MAX_LENGTH_NAME, 'Le nom complet doit faire moins de '
                . self::MAX_LENGTH_NAME . ' caractères');
            $validation->wordMaxSize($data['mail'], self::MAX_LENGTH_EMAIL, 'L\'adresse mail doit faire moins de '
                . self::MAX_LENGTH_EMAIL . ' caractères');

            $validation->emailFilterValidate($data['mail'], 'L\'email saisi n\'est pas valable');

            if (empty($validation->getErrors())) {
                    // clean $_POST data
                    $_POST['validation'] = null;
                    $testimony = array_map('trim', $_POST);
                    $testimonyManager = new TestimoniesManager();
                    $testimonyManager->insert($testimony);
                    header('Location: /');
            }
        }

        return $this->twig->render('Visitor/addTestimony/index.html.twig', ['errors' => $validation->getErrors()]);
    }
}
