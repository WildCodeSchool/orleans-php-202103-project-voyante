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

    /**
     * Edit a specific Testimony
     */
    public function edit(int $id): string
    {
        $testimoniesManager = new TestimoniesManager();
        $testimony = $testimoniesManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $testimony = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $testimoniesManager->update($testimony);
            header('Location: Admin/Testimony/show/' . $id);
        }
        return $this->twig->render('Admin/Testimony/edit.html.twig', ['testimony' => $testimony,]);
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
            $id = $testimoniesManager->insert($testimony);
            header('Location: /Admin/Testimony/show/' . $id);
        }
        return $this->twig->render('Admin/Testimony/add.html.twig');
    }


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
}
