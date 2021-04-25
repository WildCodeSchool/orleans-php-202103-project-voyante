<?php

namespace App\Controller;

use App\Services\FormValidation;

class TestController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function test()
    {
        $validation = new FormValidation();

        //test Empty or no
        $sentences = '';
        $validation->sentenceEmpty($sentences, 'case vide');

        //verification d'un nom dans un tableau de nom
        $word = 'aurelien';
        $array = ['julie','natasha','sophie','clara'];
        $validation->wordIsInArray($word, $array, 'le mot n est pas dans le tableau ');

        //verification email : vide, comforme et longueur < 320 caracteres
        $email = 'aurelien@gmail.com';
        $validation->emailValidate($email);

        //verification de la taille
        $word = 'aurelien vannier';
        $length = 1000;
        $validation->wordMaxSize($word, $length, 'la phrase est trop grande');
        $validation->wordMinSize($word, $length, 'la phrase est trop petite');

        //affichage erreur : array
        var_dump($validation->getErrors());

        // affichage erreurs formater html : string
        if ($validation->isNotErrors() === false) {
            echo $validation->displayErrorsHtml();
        }
        
    }
}
