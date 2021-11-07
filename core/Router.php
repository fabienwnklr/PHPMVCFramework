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
    public Request $request;
    public Response $response;

    protected array $routes = [];

    /**
     * Router constructor.
     * 
     * @param app\core\Request $request
     * @param app\core\Response $response
     */
    function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    function get(String $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    function post(String $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) :
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        endif;

        if (is_string($callback)) :
            return $this->renderView($callback);
        endif;
        
        if (is_array($callback)) :
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        endif;

        return call_user_func($callback, $this->request);
        
    }

    public function renderView(String $view, array $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent(String $viewContent)
    {
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView(string $view, array $params)
    {
        foreach ($params as $key => $value) :
            $$key = $value;
        endforeach;

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}