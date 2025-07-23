<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('_ROOTPATH_', __DIR__);
define('_TEMPLATEPATH_', __DIR__ . '/templates');
spl_autoload_register();

use App\Controller\Controller;

$requestUrl = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUrl, PHP_URL_PATH);
$cleanPath = ltrim($path, '/');

if (is_numeric($cleanPath)) {
    $code = (int) $cleanPath;
    $excuses = json_decode(file_get_contents(__DIR__ . '/Assets/data/excuses.json'), true);
    $excuse = null;

    foreach ($excuses as $e) {
        if ((int)$e['http_code'] === $code) {
            $excuse = $e;
            break;
        }
    }

    if ($excuse) {
        require_once __DIR__ . '/templates/errors/http_code.php';
        exit;
    } else {
        http_response_code(404);
        require_once __DIR__ . '/templates/errors/404.php';
        exit;
    }
}

if ($cleanPath !== '' && !isset($_GET['controller'])) {
    require_once __DIR__ . '/templates/pages/lost.php';
    exit;
}


$controller = new Controller;
$controller->route();
