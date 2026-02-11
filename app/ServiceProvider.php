<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Exception;
use Framework\ResponseFactory;
use Framework\ServiceContainer;
use Framework\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @throws Exception
     */
    public function register(ServiceContainer $serviceContainer): void
    {
        $homeController = new HomeController($serviceContainer->get(ResponseFactory::class));
        $taskController = new TaskController($serviceContainer->get(ResponseFactory::class));

        try {
            $serviceContainer->set(HomeController::class, $homeController);
            $serviceContainer->set(TaskController::class, $taskController);
        } catch (Exception $exception) {
            echo $exception;
        }
    }
}
