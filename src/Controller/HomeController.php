<?php

namespace App\Controller;

use App\Model\ServicesManager;

class HomeController extends AbstractController
{
    public function index()
    {
        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectAll();
        return $this->twig->render('Home/index.html.twig', [
            'services' => $services,
        ]);
    }

    public function fullStory()
    {
        return $this->twig->render('History/index.html.twig');
    }
}
