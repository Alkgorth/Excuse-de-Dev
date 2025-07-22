<?php
namespace App\Controller;

class HomeController extends Controller
{

    public function route(): void
    {
        try {
            //On meT en place une condition pour lancer le bon controller
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'home':
                        $this->home();
                        break;
                    case 'lost':
                        $this->lost();
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

    protected function home()
    {
        $this->render('pages/home', []);
    }

    protected function lost()
    {
        $this->render('pages/lost', []);
    }

}
