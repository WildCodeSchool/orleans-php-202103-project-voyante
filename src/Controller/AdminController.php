<?php

namespace App\Controller;

use App\Model\TestimoniesManager;

class AdminController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(): string
    {
        $testimoniesManager = new TestimoniesManager();
        $testimonies = $testimoniesManager->selectAll();
        return $this->twig->render('Admin/Home/index.html.twig', ['testimonies' => $testimonies]);
    }

    public function editService(): string
    {
        return $this->twig->render('Admin/Services/edit_service.html.twig');
    }
}
