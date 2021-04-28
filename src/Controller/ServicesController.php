<?php

namespace App\Controller;

use App\Model\ServicesManager;

class ServicesController extends AbstractController
{
    /**
     * List Services
     */
    public function index(): string
    {
        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectAll();
        return $this->twig->render('Admin/Services/index.html.twig', ['services' => $services]);
    }
}
