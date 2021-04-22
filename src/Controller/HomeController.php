<?php

namespace App\Controller;

use App\Model\PrestationManager;

class HomeController extends AbstractController
{
    public function index()
    {
        $prestationManager = new PrestationManager();
        $prestations = $prestationManager->selectAll();
        return $this->twig->render('Home/index.html.twig', [
            'prestations' => $prestations,
        ]);
    }
}
