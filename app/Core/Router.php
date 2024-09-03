<?php

namespace App\Core;

use Exception;

class Router
{
    protected $routes = [];

    /**
     * Register a GET route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function get(string $uri, string $controller)
    {
        $this->addRoute('GET', $uri, $controller);
    }

    /**
     * Register a POST route (optional, for extensibility).
     *
     * @param string $uri
     * @param string $controller
     */
    public function post(string $uri, string $controller)
    {
        $this->addRoute('POST', $uri, $controller);
    }

    /**
     * Add a route to the routes array.
     *
     * @param string $method
     * @param string $uri
     * @param string $controller
     */
    protected function addRoute(string $method, string $uri, string $controller)
    {
        $this->routes[$method][$uri] = $controller;
    }

    /**
     * Dispatch the request to the appropriate controller action.
     *
     * @param string $uri
     * @throws Exception
     */
    public function dispatch(string $uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            [$controller, $action] = explode('@', $this->routes[$method][$uri]);
            $this->callAction($controller, $action);
        } else {
            $this->sendNotFoundResponse();
        }
    }

    /**
     * Call the controller action.
     *
     * @param string $controller
     * @param string $action
     * @throws Exception
     */
    protected function callAction(string $controller, string $action)
    {
        $controllerClass = "App\\Controller\\{$controller}";
        
        if (!class_exists($controllerClass)) {
            throw new Exception("Controller class {$controllerClass} does not exist.");
        }

        $controllerInstance = new $controllerClass;

        if (!method_exists($controllerInstance, $action)) {
            throw new Exception("{$controllerClass} does not respond to the {$action} action.");
        }

        return $controllerInstance->$action();
    }

    /**
     * Send a 404 response.
     */
    protected function sendNotFoundResponse()
    {
        http_response_code(404);
        echo "404 - Not Found";
    }
}
