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
    public Response $response;
    public Database $db;
    public Controller $controller;
    public Session $session;
    public static Application $app;
    public static string $ROOT_DIR;

    /**
     * Constructor
     *
     * @param String $rootPath
     * @param array $config
     */
    function __construct(String $rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();

        $this->db = new Database($config['db']);
    }

    function run()
    {
        echo $this->router->resolve();
    }

       
}