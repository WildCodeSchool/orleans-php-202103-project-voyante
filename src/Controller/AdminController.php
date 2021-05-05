<?php

namespace App\Controller;

use App\Model\TestimoniesManager;
use App\Model\ServicesManager;
use App\Service\FormValidation;

class AdminController extends AbstractController
{
    public const MAX_LENGTH_NAME = 20;
    public const MAX_LENGTH_MESSAGE = 255;
    public function index(): string
    {
        $labelsTestimonies = ['Tous les messages','Uniquement les messages validés',
        'Uniquement les messages non validés'];
        $activeLabel = 1;
        $testimonies = [];
        $testimoniesManager = new TestimoniesManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            switch ($_POST['filterTestimonies']) {
                case 1:
                    $testimonies = $testimoniesManager->selectAll();
                    $activeLabel = 1;
                    break;
                case 2:
                    $testimonies = $testimoniesManager->selectedOrderValidate(true);
                    $activeLabel = 2;
                    break;
                case 3:
                    $testimonies = $testimoniesManager->selectedOrderValidate(false);
                    $activeLabel = 3;
                    break;
            }
        } else {
            $testimonies = $testimoniesManager->selectAll();
        }

        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectAll();

        return $this->twig->render('Admin/Home/index.html.twig', [
            'services' => $services,
            'testimonies' => $testimonies,
            'labelsTestimonies' => $labelsTestimonies,
            'activeLabel' => $activeLabel
        ]);
    }

    public function editService(int $id): string
    {
        $validation = new FormValidation();
        $servicesManager = new ServicesManager();
        $services = $servicesManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['id'] = $id;
            // clean $_POST data
            $services = array_map('trim', $_POST);

            $validation->sentenceEmpty($services['name'], 'Un nom complet est obligatoire');
            $validation->sentenceEmpty($services['price1hour'], 'Un tarif d\'une heure est obligatoire');
            $validation->wordMaxSize($services['name'], self::MAX_LENGTH_NAME, 'Le nom de la prestation doit
             faire moins de ' . self::MAX_LENGTH_NAME . ' caractères');
            $validation->wordMaxSize($services['description'], self::MAX_LENGTH_MESSAGE, 'La description doit
             faire moins de ' . self::MAX_LENGTH_MESSAGE . ' caractères');

            if (empty($validation->getErrors())) {
                $servicesManager->update($services);
                header('Location: /Admin/index');
            }
        }
        return $this->twig->render('Admin/Services/edit_service.html.twig', [
            'services' => $services,
            'errors' => $validation->getErrors()
        ]);
    }
    public function deleteService(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicesManager = new ServicesManager();
            $servicesManager->delete($id);
            header('Location: /Admin/index');
        }
    }
    public function addService(): string
    {
        $validation = new FormValidation();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $service = array_map('trim', $_POST);
            $validation->sentenceEmpty($service['name'], 'Un nom complet est obligatoire');
            $validation->sentenceEmpty($service['price1hour'], 'Un tarif d\'une heure est obligatoire');
            $validation->wordMaxSize($service['name'], self::MAX_LENGTH_NAME, 'Le nom de la prestation doit 
            faire moins de ' . self::MAX_LENGTH_NAME . ' caractères');
            $validation->wordMaxSize($service['description'], self::MAX_LENGTH_MESSAGE, 'La description doit 
            faire moins de ' . self::MAX_LENGTH_MESSAGE . ' caractères');

            if (empty($validation->getErrors())) {
                $servicesManager = new ServicesManager();
                $servicesManager->insert($service);
                header('Location: /Admin/index');
            }
        }
        return $this->twig->render('Admin/Services/add_service.html.twig', [
            'errors' => $validation->getErrors()
            ]);
    }

    public function deleteTestimony(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $testimoniesManager = new TestimoniesManager();
            $testimoniesManager->delete($id);
            header('Location: /Admin/index/#adminTestimonies');
        }
    }

    public function testimonyStatus(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $testimoniesManager = new TestimoniesManager();
            $testimoniesManager->updateStatus(true, $id);
            header('Location: /Admin/index/#adminTestimonies');
        }
    }
}
