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
        return $this->twig->render('Admin/Home/index.html.twig', [
            'services' => $services,
        ]);
    }

    public function editService($id): string
    {
        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $services = array_map('trim', $_POST);

            $servicesManager->update($services);
            header('Location: Admin/index');
        }
        return $this->twig->render('Admin/Services/edit_service.html.twig', ['services' => $services]);
    }

    public function addService(): string
    {
        return $this->twig->render('Admin/Services/add_service.html.twig');
    }
}
