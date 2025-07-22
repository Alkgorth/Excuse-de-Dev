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
            $this->render('errors/404', [
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

        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['http_code'], $input['tag'], $input['message'])) {
            http_response_code((400));
            echo json_encode(['error' => 'Données incomplètes']);
            return;
        }

        $newExcuse = [
            'http_code' => (int)$input['http_code'],
            'tag' => trim($input['tag']),
            'message' => trim($input['message']),
        ];

        $file = _ROOTPATH_ . '/Assets/data/excuses.json';

        if (!file_exists($file)) {
            http_response_code(404);
            echo json_encode(['error' => 'Fichier introuvable']);
            return;
        }

        $excuses = json_decode(file_get_contents($file), true);

        if (!is_array($excuses)) {
            $excuses = [];
        }

        $excuses[] = $newExcuse;

        file_put_contents($file, json_encode($excuses, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        echo json_encode(['success' => true, 'message' => 'Excuse ajoutée']);
    }
}