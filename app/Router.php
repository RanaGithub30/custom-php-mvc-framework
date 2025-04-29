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
        session_start(); // Start session for CSRF validation
        $method = $_SERVER['REQUEST_METHOD'];
        
        if (isset(self::$routes[$method][$requestedUri])) {
            $callback = self::$routes[$method][$requestedUri];
    
            // Determine request data (GET or POST)
            $requestData = ($method === 'POST') ? $_POST : $_GET;
    
            // CSRF Validation for POST requests
            if ($method === 'POST') {
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    http_response_code(403);
                }
                // unset($_SESSION['csrf_token']); // Remove token after successful validation
            }
    
            // Ensure callback is executed correctly
            if (is_callable($callback)) {
                return call_user_func($callback, $requestData);
            } elseif (is_array($callback) && count($callback) === 2) {
                [$controller, $method] = $callback;
                $controllerInstance = new $controller();
                return call_user_func([$controllerInstance, $method], $requestData);
            }
        }
    
        // If no route matches, return 404 response
        http_response_code(404);
        echo "404 Not Found";
    }
}