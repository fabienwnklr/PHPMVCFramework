<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
            <div class="form-floating mb-3">
            <input type="text" name="%s" value="%s" class="form-control%s">
            <label>%s</label>
        </div>
        ', $this->attribute, $this->model->{$this->attribute} , ' is-valid', $this->attribute);
    }
}