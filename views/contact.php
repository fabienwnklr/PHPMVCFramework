<?php

/** @var \fabwnklr\fat\View $this */
/** @var \fabwnklr\fat\ContactForm $model */
$this->title = 'Contact';

use fabwnklr\fat\form\Form;
use fabwnklr\fat\form\TexareaField;

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