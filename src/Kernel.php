<?php

namespace Framework;

use Exception;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container = new ServiceContainer();
        $this->container->set(ResponseFactory::class, new ResponseFactory());

        $responseFactory = $this->container->get(ResponseFactory::class);
        $this->router = new Router($responseFactory);
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

    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->container);
    }
}
