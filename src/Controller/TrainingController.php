<?php

namespace App\Controller;

class TrainingController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Training/index.html.twig');
    }
}
