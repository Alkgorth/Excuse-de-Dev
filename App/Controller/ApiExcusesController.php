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
                    case 'apiExcuses':
                        $this->apiExcuses();
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

    public function apiExcuses() {
        
    }
}