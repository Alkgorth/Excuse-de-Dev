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
                    case 'apiExcuses':
                        $pageController = new ApiExcusesController();
                        $pageController->route();
                        break;
                    default:
                        throw new \Exception("404");
                        break;
                }
            } else {

                $pageController = new HomeController();
                $pageController->home();
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();

            if ($message === "404") {
                $this->render('errors/404');
            } else {
                $this->render('errors/lost', [
                    'error' => $e->getMessage(),
                ]);
            }
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
            $this->render('errors/404', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
