<?php

namespace App;

class Router {
    private static $routes = [];

    public static function get($uri, $callback) {
        self::$routes['GET'][$uri] = $callback;
    }
    
    public static function post($uri, $callback) {
        self::$routes['POST'][$uri] = $callback;
    }

    public static function dispatch($requestedUri) {
        $method = $_SERVER['REQUEST_METHOD'];
        
        if (isset(self::$routes[$method][$requestedUri])) {
            $callback = self::$routes[$method][$requestedUri];

            // Ensure callback is executed only once
            if (is_callable($callback)) {
                return call_user_func($callback);
            } elseif (is_array($callback) && count($callback) === 2) {
                [$controller, $method] = $callback;
                $controllerInstance = new $controller();
                return call_user_func([$controllerInstance, $method]);
            }
        }

        // If no route matches, return 404 response
        http_response_code(404);
        echo "404 Not Found";
    }
}