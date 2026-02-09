<?php

namespace Framework;

use App\RouteProvider;
use App\ServiceProvider;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    public function __construct()
    {
        $this->router = new Router();
        $this->container = new ServiceContainer();
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    public function handleRequest(Request $request): Response
    {
        return $this->router->dispatch($request);
    }

    public function registerRoutes(RouteProviderInterface $routeProvider): void
    {
        $routeProvider->register($this->router, $this->container);
    }

    public function registerServices(ServiceProvider $serviceProvider): void
    {
        $serviceProvider->register($this->container);
    }
}
