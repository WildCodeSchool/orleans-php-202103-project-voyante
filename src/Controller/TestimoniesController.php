<?php

namespace App\Controller;

use App\Model\TestimoniesManager;

class TestimoniesController extends AbstractController
{
    /**
     * Show informations for a specific Testimony
     */
    public function show(int $id): string
    {
        $testimoniesManager = new TestimoniesManager();
        $testimony = $testimoniesManager->selectOneById($id);
        return $this->twig->render('Admin/Testimony/show.html.twig', ['testimony' => $testimony]);
    }
}
