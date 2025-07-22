<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('_ROOTPATH_', __DIR__);
define('_TEMPLATEPATH_', __DIR__ . '/templates');
spl_autoload_register();

use App\Controller\Controller;

if (isset($_GET['http_code'])) {
    $code = (int) $_GET['http_code'];
    $excuses = json_decode(file_get_contents(__DIR__ . '/Assets/data/excuses.json'), true);

    $excuse = null;
    foreach ($excuses as $e) {
        if ((int)$e['http_code'] === $code) {
            $excuse = $e;
            break;
        }
    }

    require_once __DIR__ . '/templates/errors/http_code.php';
    exit;
}

$controller = new Controller;
$controller->route();
