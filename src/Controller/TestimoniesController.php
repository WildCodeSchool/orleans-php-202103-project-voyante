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
}
