<?php

namespace Framework;

use Exception;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    private ConfigManager $configManager;

    /**
     * @throws Exception
     */
    public function __construct(mixed $config)
    {
        $this->configManager = new ConfigManager($config);

        $this->container = new ServiceContainer();
        $this->container->set(ResponseFactory::class, new ResponseFactory(
            $this->configManager->get('DEBUG'),
            $this->configManager->get('VIEW_PATH')
        ));

        $this->container->set(Database::class, new Database(__DIR__ . '/../' . $this->configManager->get('APP_DB')));

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


    /**
     * @throws Exception
     */
    public function handleRequest(Request $request): Response
    {
        try {
            return $this->router->dispatch($request);
        } catch (Exception $e) {
            throw new Exception('Cannot handle request ', 0, $e);
        }
    }

    public function registerRoutes(RouteProviderInterface $routeProvider): void
    {
        $routeProvider->register($this->router, $this->container);
    }

    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->container);
    }

    /**
     * @throws Exception
     */
    public function getDatabase(): Database
    {
        return $this->container->get(Database::class);
    }
}
