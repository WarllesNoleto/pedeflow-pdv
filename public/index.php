<?php
session_start();

define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (str_starts_with($class, $prefix)) {
        $path = BASE_PATH . '/' . str_replace('\\', '/', str_replace($prefix, 'app/', $class)) . '.php';
        if (file_exists($path)) require $path;
    }
});

require BASE_PATH . '/app/Helpers/helpers.php';

use App\Controllers\{AuthController,DashboardController,CategoryController,ProductController,AddonController,CustomerController,OrderController,DriverController,CashController,ReportController,SettingController,PublicMenuController};

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = '/pedeflow-pdv/public';
$path = str_replace($base, '', $uri) ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

$routes = [
    'GET' => [
        '/' => [DashboardController::class, 'index', true],
        '/login' => [AuthController::class, 'loginForm', false],
        '/logout' => [AuthController::class, 'logout', true],
        '/categories' => [CategoryController::class, 'index', true],
        '/products' => [ProductController::class, 'index', true],
        '/addons' => [AddonController::class, 'index', true],
        '/customers' => [CustomerController::class, 'index', true],
        '/orders' => [OrderController::class, 'index', true],
        '/orders/kanban' => [OrderController::class, 'kanban', true],
        '/drivers' => [DriverController::class, 'index', true],
        '/cash' => [CashController::class, 'index', true],
        '/reports' => [ReportController::class, 'index', true],
        '/settings' => [SettingController::class, 'index', true],
        '/menu' => [PublicMenuController::class, 'index', false],
    ],
    'POST' => [
        '/login' => [AuthController::class, 'login', false],
        '/categories' => [CategoryController::class, 'store', true],
        '/products' => [ProductController::class, 'store', true],
        '/addons' => [AddonController::class, 'store', true],
        '/customers' => [CustomerController::class, 'store', true],
        '/drivers' => [DriverController::class, 'store', true],
        '/orders' => [OrderController::class, 'store', true],
        '/orders/status' => [OrderController::class, 'updateStatus', true],
        '/cash/movement' => [CashController::class, 'movement', true],
        '/settings' => [SettingController::class, 'update', true],
    ]
];

if (!isset($routes[$method][$path])) { http_response_code(404); echo '404'; exit; }
[$controller, $action, $private] = $routes[$method][$path];
if ($private) require_auth();
(new $controller())->$action();
