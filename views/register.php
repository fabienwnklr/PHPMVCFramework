<h1 class="mb-3">Create an account</h1>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input type="text" name="firstname" class="form-control">
                <label>Firstname</label>
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
        <input type="password" name="confirmPassword" class="form-control">
        <label>Confirm password</label>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>