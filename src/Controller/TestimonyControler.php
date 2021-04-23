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
        $TestimonyManager = new TestimonyManager();
        $Testimonys = $TestimonyManager->selectAll('title');

        return $this->twig->render('Admin/Testimony/index.html.twig', ['Testimonys' => $Testimonys]);
    }

    /**
     * Show informations for a specific Testimony
     */
    public function show(int $id): string
    {
        $TestimonyManager = new TestimonyManager();
        $Testimony = $TestimonyManager->selectOneById($id);

        return $this->twig->render('Admin/Testimony/show.html.twig', ['Testimony' => $Testimony]);
    }

    /**
     * Edit a specific Testimony
     */
    public function edit(int $id): string
    {
        $TestimonyManager = new TestimonyManager();
        $Testimony = $TestimonyManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $Testimony = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $TestimonyManager->update($Testimony);
            header('Location: Admin/Testimony/show/' . $id);
        }

        return $this->twig->render('Admin/Testimony/edit.html.twig', [
            'Testimony' => $Testimony,
        ]);
    }

    /**
     * Add a new Testimony
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $Testimony = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $TestimonyManager = new TestimonyManager();
            $id = $TestimonyManager->insert($Testimony);
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
            $TestimonyManager = new TestimonyManager();
            $TestimonyManager->delete($id);
            header('Location: /Admin/Testimony/index');
        }
    }
}
