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
}
