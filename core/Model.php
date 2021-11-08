<?php

namespace app\core;

abstract class Model
{

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    /**
     * Adding data to the model object
     */
    public function loadData(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public array $errors = [];

    /**
     * Validate the model data
     *
     * @return void
     */
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) :
            $value = $this->{$attribute};

            foreach ($rules as $rule) :
                $ruleName = $rule;

                if (!is_string($ruleName)) :
                    $ruleName = $rule[0];
                endif;

                if ($ruleName === self::RULE_REQUIRED && !$value) :
                    $this->addError($attribute, self::RULE_REQUIRED);
                endif;

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)):
                    $this->addError($attribute, self::RULE_EMAIL);
                endif;

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']):
                    $this->addError($attribute, self::RULE_MIN, $rule);
                endif;

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']):
                    $this->addError($attribute, self::RULE_MAX, $rule);
                endif;

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}):
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                endif;

                // if ($ruleName === self::RULE_UNIQUE && $this->findBy($attribute, $value)):
                //     $this->addError($attribute, self::RULE_UNIQUE, $rule);
                // endif;

            endforeach;

        endforeach;

        return empty($this->errors);
    }

    /**
     * Function for add error to model
     *
     * @param string $attribute
     * @param string $rule
     * @return void
     */
    public function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';

        foreach ($params as $key => $value) :
            $message = str_replace("{{$key}}", $value, $message);
        endforeach;

        $this->errors[$attribute][] = $message;
    }

    /**
     * Function returning messages corresponding to rules
     * 
     * @return array
     */
    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'This field must be unique'
        ];
    }

    public function hasError(string $attribute): array|bool
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError(string $attribute): string
    {
        return $this->errors[$attribute][0] ?? '';
    }
}