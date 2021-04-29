<?php

namespace App\Controller;

use App\Model\ServicesManager;

class AdminController extends AbstractController
{
    public function deleteService($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicesManager = new ServicesManager();
            $servicesManager->delete($id);
            header('Location: /Admin/index');
        }
    }
}
