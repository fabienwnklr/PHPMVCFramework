<?php

namespace app\controllers;

use fabwnklr\fat\Request;
use fabwnklr\fat\Response;
use fabwnklr\fat\Controller;
use fabwnklr\fat\Application;
use app\models\ContactForm;

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

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();

        if ($request->isPost()) {
            $contact->loadData($request->getBody());

            if ($contact->validate() && $contact->send()) {
                // Send email
                Application::$app->session->setFlash('success', 'Your message has been sent successfully.');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', ['model' => $contact]);
    }

    public static function handleContact(Request $request)
    {
        $body = $request->getBody();
        print_r($body);
        return 'Handling submitted data';
    }
}