<?php

namespace App\Controller;

use App\Model\TestimoniesManager;

class TestimoniesController extends AbstractController
{
    /**
     * Delete a specific Testimony
     */
    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $testimoniesManager = new TestimoniesManager();
            $testimoniesManager->delete($id);
            header('Location: /Admin/Testimony/index');
        }
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
