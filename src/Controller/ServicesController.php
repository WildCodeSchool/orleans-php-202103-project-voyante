<?php

namespace App\Controller;

use App\Model\ServicesManager;

class ServicesController extends AbstractController
{
    /**
     * Show informations for a specific Testimony
     */
    public function show(int $id): string
    {
        $servicesManager = new ServicesManager();
        $service = $servicesManager->selectOneById($id);
        return $this->twig->render('Admin/Services/show.html.twig', ['service' => $service]);
    }
}
