<?php

namespace Framework;

class Router
{
    /** @var Route[] */
    public array $routes = [];

    public function __construct()
    {
    }

    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->path === $request->path) {
                $matchedRoute = $route;
            }
        }

        if (!isset($matchedRoute)) {
            return new Response(404, 'NIET GEVONDEN WOLLAH', null);
        }

        return call_user_func($matchedRoute->callback);
    }

    public function addRoute(string $method, string $path, callable $callback): void
    {
        $this->routes[] = new Route($method, $path, $callback);
    }
}
