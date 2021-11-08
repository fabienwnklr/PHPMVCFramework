<h1 class="mb-3">Create an account</h1>

<?php $form = app\core\form\Form::begin('', 'post') ?>
    <?= $form->field($model, 'firstname') ?>
    <?= $form->field($model, 'lastname') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password') ?>
    <?= $form->field($model, 'passwordConfirm') ?>

    <button type="submit" class="btn btn-primary">Register</button>
<?= app\core\form\Form::end() ?>

<!-- <div class="row">
    <div class="col">
        <div class="form-floating mb-3">
            <input type="text" name="firstname" value="<?php echo $model->firstname ?? '' ?>" class="form-control <?= $model->hasError('firstname') ? 'is-invalid' : '' ?>">
            <label>Firstname</label>
            <div class="invalid-feedback">
                <?php //echo $model->getFirstError('firstname') ?>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-floating mb-3">
            <input type="text" name="lastname" class="form-control">
            <label>Lastname</label>
        </div>

    </div>
</div>
<div class="form-floating mb-3">
    <input type="email" name="email" class="form-control">
    <label>Email address</label>
</div>
<div class="form-floating mb-3">
    <input type="password" name="password" class="form-control">
    <label>Password</label>
</div>
<div class="form-floating mb-3">
    <input type="password" name="passwordConfirm" class="form-control">
    <label>Password confirm</label>
</div> -->