<?php

namespace App;

use App\Controllers\TaskController;
use Framework\RouteProviderInterface;
use Framework\Router;
use App\Controllers\HomeController;
use Framework\ServiceContainer;
use Exception;

class RouteProvider implements RouteProviderInterface
{
    /**
     * @throws Exception
     */
    public function register(Router $router, ServiceContainer $container): void
    {
        /** @var HomeController $homeController */
        $homeController = $container->get(HomeController::class);

        $router->addRoute('GET', '/', [$homeController, "index"]);
        $router->addRoute('GET', '/about', [$homeController, "about"]);

        /** @var TaskController $taskController */
        $taskController = $container->get(TaskController::class);
        $router->addRoute('GET', '/task', [$taskController, "index"]);
    }
}
