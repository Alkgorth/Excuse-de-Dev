<?php

namespace App\Controller;

use Exception;

class ApiExcusesController extends Controller
{
    public function route(): void
    {
        header('Content-Type: application/json');

        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'getExcuses':
                        $this->getExcuses();
                        break;
                    case 'addExcuses':
                        $this->addExcuses();
                        break;
                     default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/lost', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getExcuses() {

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['error' => 'Méthode non autorisée']);
            return;
        }

        $file = _ROOTPATH_ . '/Assets/data/excuses.json';

        if (!file_exists($file)) {
            http_response_code(404);
            echo json_encode(['error' => 'Fichier introuvable']);
            return;
        }
        
        $data = json_decode(file_get_contents($file), true);

        
        if (empty($data) || !is_array($data)) {
            http_response_code(500);
            echo json_encode(['error' => 'Données invalides']);
            return;
        }

        $randomExcuse = $data[array_rand($data)];
        echo json_encode(['excuse' => $randomExcuse]);
    }

    public function addExcuses() {
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Méthode non autorisée']);
            return;
        }

        $file = _ROOTPATH_ . '/Assets/data/excuses.json';

        if (!file_exists($file)) {
            http_response_code(404);
            echo json_encode(['error' => 'Fichier introuvable']);
            return;
        }

        
    }
}