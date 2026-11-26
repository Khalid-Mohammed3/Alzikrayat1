<?php

/**
 * Router Class
 * Handles application routes manually using Regular Expressions
 */

class Router
{
    private $routes = [];

    /**
     * Register a new route.
     */
    public function add($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    /**
     * Match the requested URL and execute its handler.
     */
    public function dispatch($method, $uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes as $route) {

            $pattern = preg_quote($route['path'], '#');

            $pattern = preg_replace(
                '/\\\\\{([a-zA-Z_][a-zA-Z0-9_]*)\\\\\}/',
                '(?P<$1>[^/]+)',
                $pattern
            );

            $pattern = '#^' . $pattern . '$#';

            if (
                $method === $route['method'] &&
                preg_match($pattern, $path, $matches)
            ) {

                $params = array_filter(
                    $matches,
                    'is_string',
                    ARRAY_FILTER_USE_KEY
                );

                $handler = $route['handler'];

                if (is_callable($handler)) {
                    return call_user_func($handler, $params);
                }

                if (is_array($handler)) {

                    [$controller, $action] = $handler;

                    require_once "../controllers/$controller.php";

                    $controllerObject = new $controller();

                    return call_user_func_array(
                        [$controllerObject, $action],
                        array_values($params)
                    );
                }
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}