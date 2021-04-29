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
    public function index()
    {
        $services = $this->loadAllServices();
        return $this->twig->render('Admin/Home/index.html.twig', ['services' => $services]);
    }

    public function editService()
    {
        return $this->twig->render('Admin/Services/edit_service.html.twig');
    }
    /**
     * List Services
     */
    private function loadAllServices(): array
    {
        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectAll();
        return $services;
    }
}
