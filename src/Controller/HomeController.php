<?php

namespace App\Controller;

use App\Model\ServicesManager;
use App\Model\TestimoniesManager;

class HomeController extends AbstractController
{
    public function index()
    {
        $testimoniesManager = new TestimoniesManager();
        $testimonies = $testimoniesManager->selectAll();

        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectAll();
        return $this->twig->render('Visitor/Home/index.html.twig', [
            'services' => $services,
            'testimonies' => $testimonies
        ]);
    }

    public function fullStory()
    {
        return $this->twig->render('Visitor/History/index.html.twig');
    }
}
