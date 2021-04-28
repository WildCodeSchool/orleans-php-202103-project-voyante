<?php

namespace App\Controller;

class AdminController extends AbstractController
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
        return $this->twig->render('Admin/Home/index.html.twig');
    }

    public function editService()
    {
        return $this->twig->render('Admin/Services/edit_service.html.twig');
    }

    public function addService()
    {
        return $this->twig->render('Admin/Services/add_service.html.twig');
    }
}
