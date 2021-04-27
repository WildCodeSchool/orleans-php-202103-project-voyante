<?php

namespace App\Controller;

use App\Model\ServicesManager;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Home/index.html.twig');
    }

    public function fullStory()
    {
        return $this->twig->render('History/index.html.twig');
    }
}
