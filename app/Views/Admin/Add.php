<?php include_once __DIR__ . '/../Layout/Header.php' ?>

<?php if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error == 'fields') {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Please fill in all fields!

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
} elseif ($error == 'password_confirm') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            The password does not match the password confirmation!

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
} elseif ($error == 'invalid_username') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            The provided username is not valid! The Username should only contain letters and numbers.

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
} elseif ($error == 'username_exists') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            The chosen username already exists!

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
} elseif ($error == 'email') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            The provided email is not valid!

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
} elseif ($error == 'email_exists') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            An account with the provided email already exists!

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
} elseif ($error == 'loginfields') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Please fill in both username and password to login!

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
} elseif ($error == 'invalid_login') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            The provided combination of username/password cannot be found in our records!

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
}
} ?>

<div class="container bootstrap snippet my-5">
    <h3>Create User</h3>
    <form action="/admin/add" method="post">
        <div class="form-group">
            <input type="text" class="form-control <?php echo (isset($error) && in_array($error, ['invalid_username', 'username_exists']) ? 'is-invalid' : ''); ?>" placeholder="Username" value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>" name="username" required />
        </div>
        <div class="form-group">
            <input type="email" class="form-control <?php echo (isset($error) && in_array($error, ['email', 'email_exists']) ? 'is-invalid' : ''); ?>" placeholder="Email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" name="email" required />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" value="" name="password" required />
        </div>
        <div class="form-group">
            <input type="password" class="form-control <?php echo (isset($error) && in_array($error, ['password_confirm']) ? 'is-invalid' : ''); ?>" placeholder="Confirm Password" value="" name="password_confirm" required />
        </div>
        <div class="form-group">
            <input type="submit" class="btnSubmit" value="Create" />
        </div>
    </form>
</div>

<?php include_once __DIR__ . '/../Layout/Footer.php' ?>