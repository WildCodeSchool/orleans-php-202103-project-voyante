<?php

namespace App\Controller;

use App\Model\ServicesManager;

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
    public function index(): string
    {
        return $this->twig->render('Admin/Home/index.html.twig');
    }

    public function editService(): string
    {
        return $this->twig->render('Admin/Services/edit_service.html.twig');
    }

    /**
     * Add a new Services
     */
    public function addService(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $service = array_map('trim', $_POST);
            $servicesManager = new ServicesManager();
            $servicesManager->insert($service);
            header('Location: /Admin/index');
        }
        return $this->twig->render('Admin/Services/edit_service.html.twig');
    }
}
