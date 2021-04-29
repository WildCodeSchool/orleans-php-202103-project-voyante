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
        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectAll();
        return $this->twig->render('Admin/Home/index.html.twig', ['services' => $services]);
    }
}
