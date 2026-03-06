<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\TaskController;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use Exception;
use Framework\Database;
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
        // Repositories
        $taskRepository = new TaskRepository($serviceContainer->get(Database::class));
        $projectRepository = new ProjectRepository($serviceContainer->get(Database::class));

        $serviceContainer->set(TaskRepository::class, $taskRepository);
        $serviceContainer->set(ProjectRepository::class, $projectRepository);

        // Controllers
        $homeController = new HomeController($serviceContainer->get(ResponseFactory::class));
        $taskController = new TaskController($serviceContainer->get(ResponseFactory::class), $taskRepository, $projectRepository);
        $projectRepository = new ProjectController($serviceContainer->get(ResponseFactory::class), $projectRepository, $taskRepository);

        $serviceContainer->set(HomeController::class, $homeController);
        $serviceContainer->set(TaskController::class, $taskController);
        $serviceContainer->set(ProjectController::class, $projectRepository);
    }
}
