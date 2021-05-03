<?php

namespace App\Controller;

use App\Model\TestimoniesManager;
use App\Model\ServicesManager;

class AdminController extends AbstractController
{
    public function index(): string
    {
        $testimoniesManager = new TestimoniesManager();
        $testimonies = $testimoniesManager->selectAll();

        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectAll();
        return $this->twig->render('Admin/Home/index.html.twig', [
            'services' => $services,
            'testimonies' => $testimonies
        ]);
    }
    public function editService(int $id): string
    {
        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST["id"] = $id;
            // clean $_POST data
            $services = array_map('trim', $_POST);
            $servicesManager->update($services);
            header('Location: /Admin/index');
        }
        return $this->twig->render('Admin/Services/edit_service.html.twig', [
            'services' => $services
        ]);
    }
    public function deleteService(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicesManager = new ServicesManager();
            $servicesManager->delete($id);
            header('Location: /Admin/index');
        }
    }
    public function addService(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $service = array_map('trim', $_POST);
            $servicesManager = new ServicesManager();
            $servicesManager->insert($service);
            header('Location: /Admin/index');
        }
        return $this->twig->render('Admin/Services/add_service.html.twig');
    }

    public function testimonyStatus(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $testimoniesManager = new TestimoniesManager();
            $testimoniesManager->updateStatus(true, $id);
            header('Location: /Admin/index/#adminTestimonies');
        }
    }

    public function deleteTestimony(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $testimoniesManager = new TestimoniesManager();
            $testimoniesManager->delete($id);
            header('Location: /Admin/index/#adminTestimonies');
        }
    }
}
