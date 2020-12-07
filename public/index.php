<?php
session_start();

use Core\Application;

define('JS_DIR', dirname(__DIR__) . '/resources/js');
define('CSS_DIR', dirname(__DIR__) . '/resources/css');

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/database/database.php';

$app = new Application(dirname(__DIR__));

$app->router->get('/', [\App\Controllers\SiteController::class, 'index']);
$app->router->post('/create-task', [\App\Controllers\SiteController::class, 'createTask']);
$app->router->get('/login', [\App\Controllers\SiteController::class, 'login']);
$app->router->get('/edit', [\App\Controllers\Admin\AdminController::class, 'index']);
$app->router->post('/edit', [\App\Controllers\Admin\AdminController::class, 'edit']);
$app->router->get('/logout', [\App\Controllers\Admin\AdminController::class, 'logout']);
$app->router->post('/login', [\App\Controllers\LoginController::class, 'login']);

$app->run();