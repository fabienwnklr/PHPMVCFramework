<?php

/** @var \app\core\View $this */
/** @var \app\core\ContactForm $model */
$this->title = 'Contact';

use app\core\form\Form;
use app\core\form\TexareaField;

?>

<h1>Contact</h1>

<?php $form = Form::begin(); ?>
<?= $form->field($model, 'subject') ?>
<?= $form->field($model, 'email') ?>
<?= new TexareaField($model, 'body') ?>

<button type="submit" class="btn btn-primary">Submit</button>

<?
Form::end();
?>