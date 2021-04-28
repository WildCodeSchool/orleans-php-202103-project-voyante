<?php

namespace App\Controller;

use App\Model\ServicesManager;

class ServicesController extends AbstractController
{
    /**
     * Edit a specific Services
     */
    public function edit(int $id): string
    {
        $servicesManager = new ServicesManager();
        $service = $servicesManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $services = array_map('trim', $_POST);

            $servicesManager->update($services);
            header('Location: Admin/Services/index');
        }
        return $this->twig->render('Admin/Services/edit_service.html.twig', ['service' => $service,]);
    }
}
