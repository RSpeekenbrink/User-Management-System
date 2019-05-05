<?php include_once __DIR__ . '/Layout/Header.php' ?>

<?php if (isset($_GET['edit'])) {
	?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		Profile data succesfully updated!

		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php
} elseif (isset($_GET['password'])) {
	?>
	<div class="alert alert-success" role="alert">
		Password Successfully Changed

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
} elseif ($error == 'password') {
	?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Wrong password provided

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
} elseif ($error == 'password_confirm') {
	?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			The new password does not match the new password confirmation!

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
}
} ?>

<div class="container bootstrap snippet my-5">
	<div class="row">
		<div class="col-sm-10">
			<h1><?php echo $user->username ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="text-center">
				<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
			</div>
		</div>

		<div class="col-sm-9">
			<hr>

			<h2>Profile Data</h2>

			<form class="form" action="updateProfile" method="post">
				<div class="form-group">
					<div class="col-xs-6">
						<label for="username">
							<h4>Username</h4>
						</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $user->username ?>" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-6">
						<label for="email">
							<h4>Email</h4>
						</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user->email ?>" required>
					</div>
				</div>

				<input type="submit" class="btnSubmit" value="Save" />
			</form>

			<hr>

			<h2>Change Password</h2>

			<form class="form" action="changePassword" method="post">
				<div class="form-group">
					<div class="col-xs-6">
						<label for="current_password">
							<h4>Current Password</h4>
						</label>
						<input type="password" class="form-control <?php echo (isset($error) && in_array($error, ['password']) ? 'is-invalid' : ''); ?>" name="current_password" id="current_password" placeholder="Current Password" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-6">
						<label for="password">
							<h4>New Password</h4>
						</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="New Password" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-6">
						<label for="password_confirm">
							<h4>New Password Confirmation</h4>
						</label>
						<input type="password" class="form-control <?php echo (isset($error) && in_array($error, ['password_confirm']) ? 'is-invalid' : ''); ?>" name="password_confirm" id="password_confirm" placeholder="New Password Confirmation" required>
					</div>
				</div>

				<input type="submit" class="btnSubmit" value="Change" />
			</form>

			<hr>

			<h2>Change Security Question</h2>

			TODO

			<hr>

		</div>
	</div>
</div>

<?php include_once __DIR__ . '/Layout/Footer.php' ?>