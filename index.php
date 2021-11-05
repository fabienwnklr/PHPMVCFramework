<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\core\Application;

$app = new Application();

$app->router->get('/', function() {
    echo 'Home';
});

$app->router->get('/contact', function() {
    echo 'Contact';
});

$app->run();
