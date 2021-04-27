<?php

namespace App\Controller;

use App\Model\TestimoniesManager;

class TestimoniesController extends AbstractController
{
    /**
     * List Testimonys
     */
    public function index(): string
    {
        $testimoniesManager = new TestimoniesManager();
        $testimonys = $testimoniesManager->selectAll();
        return $this->twig->render('Admin/Testimony/index.html.twig', ['testimonys' => $testimonys]);
    }

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
