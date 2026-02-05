<?php

namespace Framework;

use App\RouteProvider;

class Kernel
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
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

    public function registerRoutes(RouteProvider $routeProvider): void
    {
        $routeProvider->register($this->router);
    }
}
