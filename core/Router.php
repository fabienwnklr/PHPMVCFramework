<?php

namespace app\core;

use app\utils\Debug;

/**
 * Class Router
 * 
 * @author Fabien <fabien.winkler@outlook.fr>
 * @package app\core
 */
class Router
{
    protected array $routes = [];
    public Request $request;

    function __construct(\app\core\Request $request)
    {
        $this->request = $request;
    }

    function get(String $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            echo 'Not found.';
            return;
        }

        call_user_func($callback);
        
    }
}