<?php

namespace App;

use Framework\RouteProviderInterface;
use Framework\Router;
use App\Controller\HomeController;

class RouteProvider implements RouteProviderInterface
{
    public function register(Router $router): void
    {
        $homeController = new HomeController();
        $router->addRoute('GET', '/', [$homeController, 'index']);
        $router->addRoute('GET', '/about', [$homeController, 'about']);
    }
}
