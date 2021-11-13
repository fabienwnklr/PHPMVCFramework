<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';

    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = '';
        $this->model = $model;
        $this->attribute = $attribute;
    }

    /**
     * Generate input text field
     * 
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '
            <div class="form-floating mb-3">
                <input type="%s" name="%s" value="%s" placeholder="%s" class="form-control%s">
                <label>%s</label>
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
            ',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getLabel($this->attribute),
            $this->model->getFirstError($this->attribute),
        );
    }

    /**
     * Generate input password field
     * 
     * @return string
     */
    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;

        return $this;
    }
}
