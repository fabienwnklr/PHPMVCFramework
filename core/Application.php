<?php

namespace app\core;

/**
 * Class Application
 * 
 * @author Fabien <fabien.winkler@outlook.fr>
 * @package app\core
 */
class Application
{
    public Router $router;
    public Request $request;

    function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    function run()
    {
        $this->router->resolve();
    }

       
}