<?php
require_once "../vendor/autoload.php";
require_once "../db.php";
require_once "../app/models/Student.php";
require_once "../app/controllers/StudentController.php";

use Illuminate\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

// Blade setup
$views = "../app/views";
$cache = "../cache/views";

$blade = new Factory(
    new Illuminate\View\Engines\EngineResolver(),
    new Illuminate\View\FileViewFinder(new Filesystem(), [$views]),
    new Dispatcher(new Container())
);

// Model & Controller
$studentModel = new Student($conn);
$controller = new StudentController($studentModel, $blade);

// Routing
$page = $_GET['page'] ?? 'index';

switch ($page) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_GET['id']);
        break;
    case 'delete':
        $controller->delete($_GET['id']);
        break;
    default:
        $controller->index();
}
