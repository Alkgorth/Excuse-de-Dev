<?php

namespace App\Controller;

use Exception;

class ApiExcusesController extends Controller
{
    public function route(): void
    {
        header('Content-Type: application/json');

        try {
            //On met en place une condition pour lancer le bon controller
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'getExcuses':
                        $this->getExcuses();
                        break;
                     default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getExcuses() {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = file_get_contents(_ROOTPATH_ . '/Assets/data/excuses.json');
            echo $data;
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            $newExcuse =json_decode($json, true);

            $excuses = json_decode(file_get_contents(_ROOTPATH_ . '/Assets/data/excuses.json'), true);
            $excuses = $newExcuse;

            file_put_contents('./Assets/data/excuses.json', json_encode($excuses, JSON_PRETTY_PRINT));
            echo json_encode(['status' => 'ok']);
            exit;
        }
    }
}