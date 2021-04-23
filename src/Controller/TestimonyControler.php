<?php

namespace App\Controller;

use App\Model\TestimonyManager;

class TestimonyController extends AbstractController
{
    /**
     * List Testimonys
     */
    public function index(): string
    {
        $testimonyManager = new TestimonyManager();
        $testimonys = $testimonyManager->selectAll('title');

        return $this->twig->render('Admin/Testimony/index.html.twig', ['testimonys' => $testimonys]);
    }

    /**
     * Show informations for a specific Testimony
     */
    public function show(int $id): string
    {
        $testimonyManager = new TestimonyManager();
        $testimony = $testimonyManager->selectOneById($id);

        return $this->twig->render('Admin/Testimony/show.html.twig', ['testimony' => $testimony]);
    }

    /**
     * Edit a specific Testimony
     */
    public function edit(int $id): string
    {
        $testimonyManager = new TestimonyManager();
        $testimony = $testimonyManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $testimony = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $testimonyManager->update($testimony);
            header('Location: Admin/Testimony/show/' . $id);
        }

        return $this->twig->render('Admin/Testimony/edit.html.twig', [
            'testimony' => $testimony,
        ]);
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
            $testimonyManager = new TestimonyManager();
            $id = $testimonyManager->insert($testimony);
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
            $testimonyManager = new TestimonyManager();
            $testimonyManager->delete($id);
            header('Location: /Admin/Testimony/index');
        }
    }
}
