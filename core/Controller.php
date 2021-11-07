<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';

    public function setLayout(string $layout): void
    {
        $this->layout = $layout; 
    }

    public function render($view, $params = []): string | false
    {
        return Application::$app->router->renderView($view, $params);
    }
}