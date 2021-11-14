<?php

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    /**
     * Register a new user
     */
    public function register(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }

    /**
     * Function rules returning a list of rules for the model
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => [
                self::RULE_REQUIRED
            ],
            'lastname' => [
                self::RULE_REQUIRED
            ],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'email']
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 8],
                [self::RULE_MAX, 'max' => 155]
            ],
            'passwordConfirm' => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password']
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'firstname',
            'lastname',
            'email',
            'password'
        ];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Password Confirm'
        ];
    }

    public function getDisplayName(): string
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }
}
