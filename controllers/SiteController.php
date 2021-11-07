<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

/**
 * Class SiteController.
 * 
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function home()
    {
        $params = ['name' => 'Fabien MVC Framework'];

        return $this->render('home', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public static function handleContact(Request $request)
    {
        $body = $request->getBody();
        print_r($body);
        return 'Handling submitted data';
    }
}