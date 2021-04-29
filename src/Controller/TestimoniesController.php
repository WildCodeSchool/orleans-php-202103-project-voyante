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
     * Add a new Testimony
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $testimony = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $testimoniesManager = new TestimoniesManager();
            $testimoniesManager->insert($testimony);
            header('Location: /Admin/index');
        }
        return $this->twig->render('Admin/Home/index.html.twig');
    }
}
