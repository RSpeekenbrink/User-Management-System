<?php include_once __DIR__ . '/Layout/Header.php' ?>

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
} elseif ($error == 'answer') {
	?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Wrong Answer given!

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
} elseif ($error == 'security_question') {
	?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			You do not have any security questions set up and are therefore not able to reset your password. Please contact the staff.

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
} elseif ($error == 'invalid_username') {
	?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			The provided username/email cannot be found in our records!

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
}
} ?>


<div class="container bootstrap snippet my-5">
	<h3>Forgot Password</h3>

	<?php if (!isset($_GET['user'])) { ?>
		<form action="/forgot-password" method="post">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Username/Email" value="" name="username" required />
			</div>

			<div class="form-group">
				<input type="submit" class="btnSubmit" value="Submit" />
			</div>
		</form>
	<?php } else {
	$item = App\Models\User::find($_GET['user']); ?>
		<form action="/resetpassword" method="post">
			<input type="hidden" name="user" value="<?php echo $item->id ?>">

			<div class=" form-group">
				<div class="col-xs-6">
					<label for="current_password">
						<h4><?php echo $item->security_question ?></h4>
					</label>
					<input type="text" class="form-control" name="answer" id="answer" placeholder="<?php echo $item->security_question ?>" required>
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

			<div class="form-group">
				<input type="submit" class="btnSubmit" value="Submit" />
			</div>
		</form>
	<?php } ?>
</div>


<?php include_once __DIR__ . '/Layout/Footer.php' ?>