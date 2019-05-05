<?php include_once __DIR__ . '/Layout/Header.php' ?>

<?php if (isset($_GET['register'])) { ?>
	<div class="alert alert-success" role="alert">
		You succesfully registered! Please login below...
	</div>
<?php } else if (isset($_GET['logout'])) { ?>
	<div class="alert alert-success" role="alert">
		Logout Succesfull
	</div>
<?php } ?>

<?php if (isset($_GET['error'])) {
	$error = $_GET['error'];

	if ($error == 'fields') { ?>
		<div class="alert alert-danger" role="alert">
			Please fill in all fields!
		</div>
	<?php } else if ($error == 'password_confirm') { ?>
		<div class="alert alert-danger" role="alert">
			The password does not match the password confirmation!
		</div>
	<?php } else if ($error == 'invalid_username') { ?>
		<div class="alert alert-danger" role="alert">
			The provided username is not valid! The Username should only contain letters and numbers.
		</div>
	<?php } else if ($error == 'username_exists') { ?>
		<div class="alert alert-danger" role="alert">
			The chosen username already exists!
		</div>
	<?php } else if ($error == 'email') { ?>
		<div class="alert alert-danger" role="alert">
			The provided email is not valid!
		</div>
	<?php } else if ($error == 'email_exists') { ?>
		<div class="alert alert-danger" role="alert">
			An account with the provided email already exists!
		</div>
	<?php }
} ?>

<div class="container login-container">
	<div class="row">
		<div class="col-md-6 login-form-1">
			<h3>Login</h3>
			<form action="/login" method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username/Email" value="" name="username" required />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" value="" name="password" required />
				</div>
				<div class="form-group">
					<input type="submit" class="btnSubmit" value="Login" />

					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="remember-me" name="remember-me">
						<label class="form-check-label" for="remember-me">Remember Me</label>
					</div>
				</div>
				<div class="form-group">
					<a href="/forgot-password" class="ForgetPwd">Forgot Password?</a>
				</div>
			</form>
		</div>
		<div class="col-md-6 login-form-2">
			<h3>Register</h3>
			<form action="/register" method="post">
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
					<input type="submit" class="btnSubmit" value="Register" />
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once __DIR__ . '/Layout/Footer.php' ?>