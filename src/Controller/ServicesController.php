<?php

namespace App\Controller;

use App\Model\ServicesManager;

class ServicesController extends AbstractController
{
    /**
     * Add a new Services
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $service = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $servicesManager = new ServicesManager();
            $id = $servicesManager->insert($service);
            header('Location: /Admin/Services/show/' . $id);
        }
        return $this->twig->render('Admin/Services/add.html.twig');
    }
}
