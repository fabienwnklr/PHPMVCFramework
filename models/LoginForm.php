<?php

namespace app\models;

use fabwnklr\fat\Model;
use fabwnklr\fat\Utils;
use app\models\User;
use fabwnklr\fat\Application;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    /**
     * Return label for each field
     * @return array
     */
    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    /**
     * Login an user
     *
     * @return boolean
     */
    public function login(): bool
    {
        $user = User::findOne(['email' => $this->email]);

        if (!$user):
            $this->addError('email', 'User cannot find');
            return false;
        endif;

        if (!password_verify($this->password, $user->password)):
            $this->addError('password', 'Password is incorrect');
            return false;
        endif;

        return Application::$app->login($user);
    }
}