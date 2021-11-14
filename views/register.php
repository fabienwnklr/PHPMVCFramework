<?php

?>
<h1 class="mb-3">Create an account</h1>

<?php $form = fabwnklr\fat\form\Form::begin('', 'post') ?>
<div class="row">
    <div class="col">
        <?= $form->field($model, 'firstname') ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'lastname') ?>
    </div>
</div>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password')->passwordField() ?>

    <?= $form->field($model, 'passwordConfirm')->passwordField() ?>


<button type="submit" class="btn btn-primary">Register</button>
<?= fabwnklr\fat\form\Form::end() ?>