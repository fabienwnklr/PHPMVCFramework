<?php

namespace app\controllers;

use app\models\User;
use app\core\Request;
use app\core\Response;
use app\core\Controller;
use app\core\Application;
use app\models\LoginForm;
use app\core\middlewares\AuthMiddleware;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();

        if ($request->isPost()) :
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()):
                $response->redirect('/');
                return;
            endif;
        endif;

        // $this->setLayout('auth');
        return $this->render('login', ['model' => $loginForm]);
    }

    public function register(Request $request)
    {
        $userModel = new User();

        if ($request->isPost()) :
            $userModel->loadData($request->getBody());

            if ($userModel->validate() && $userModel->register()) :
                Application::$app->session->setFlash('success', 'Thanks for registering!');
                Application::$app->response->redirect('/');
                exit;
            endif;

            return $this->render('register', ['model' => $userModel]);
        endif;

        // $this->setLayout('auth');
        return $this->render('register', ['model' => $userModel]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile(Request $request)
    {
        
        return $this->render('profile');
    }
}
