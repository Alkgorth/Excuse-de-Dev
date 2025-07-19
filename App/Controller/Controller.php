<?php
namespace App\Controller;

class Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['controller'])) {
                switch ($_GET['controller']) {
                    case 'pages':
                        $pageController = new HomeController();
                        $pageController->route();
                        break;
                    default:
                        throw new \Exception("Désolé cette page n'existe pas 😣");
                        break;
                }
            } else {

                $pageController = new HomeController();
                $pageController->home();
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function render(string $path, array $params = []): void
    {

        $filePath = _ROOTPATH_ . '/templates/' . $path . '.php';

        try {
            if (! file_exists($filePath)) {
                throw new \Exception("Fichier non trouvé : " . $filePath);
            } else {
                extract($params);
                require_once $filePath;
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
