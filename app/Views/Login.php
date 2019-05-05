<?php include_once __DIR__ . '/Layout/Header.php' ?>

<?php if ($user) { ?>
	<div class="container my-5">
		<div class="card my-5">
			<div class="card-body">
				<h5 class="card-title">Oh hello there!</h5>
				<p class="card-text">It seems that you already logged in.</p>
				<a href="/logout" class="btn btn-primary">Logout</a>
			</div>
		</div>
	</div>
<?php } else {
	?>

	<?php if (isset($_GET['register'])) {
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			You succesfully registered! Please login below...

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
} elseif (isset($_GET['logout'])) {
	?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			Logout Succesfull

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
} elseif (isset($_GET['reset'])) {
	?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			Password Reset Succesfull

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
} ?>

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

<?php
}
include_once __DIR__ . '/Layout/Footer.php';
?>