<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Visitor/Home/index.html.twig');
    }

    public function fullStory()
    {
        return $this->twig->render('History/index.html.twig');
    }
}
