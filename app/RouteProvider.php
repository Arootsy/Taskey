<?php

namespace App;

use App\Controllers\ProjectController;
use App\Controllers\TaskController;
use Framework\Request;
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
        $homeController = $container->get(HomeController::class);

        $router->addRoute('GET', '/', function (Request $request) use ($homeController) {
            return $homeController->index($request);
        });

        $router->addRoute('GET', '/about', function (Request $request) use ($homeController) {
            return $homeController->about($request);
        });


        // TASKS
        $taskController = $container->get(TaskController::class);

        $router->addRoute('GET', '/tasks', function (Request $request) use ($taskController) {
            return $taskController->index($request);
        });

        $router->addRoute('GET', '/tasks/(?<id>\d+)', function (Request $request) use ($taskController) {
            return $taskController->show($request);
        });

        $router->addRoute('POST', '/tasks/create', function (Request $request) use ($taskController){
            return $taskController->store($request);
        });

        $router->addRoute('POST', '/tasks/update', function (Request $request) use ($taskController) {
            return $taskController->update($request);
        });

        $router->addRoute('POST', '/tasks/(?<id>\d+)/delete', function (Request $request) use ($taskController) {
            return $taskController->delete($request);
        });

        // PROJECTS
        $projectController = $container->get(ProjectController::class);
        $router->addRoute('GET', '/projects', function (Request $request) use($projectController) {
            return $projectController->index($request);
        });
    }
}
