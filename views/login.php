<?php

/** @var $model \app\models\User */
?>
<h1>Login</h1>

<?php $form = fabwnklr\fat\form\Form::begin('', 'post') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordField() ?>


    <button type="submit" class="btn btn-primary">Register</button>
<?= fabwnklr\fat\form\Form::end() ?>