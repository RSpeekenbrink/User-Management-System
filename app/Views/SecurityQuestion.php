<?php include_once __DIR__ . '/Layout/Header.php';

if (isset($_GET['force'])) {
	?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		A security question is required for later password resets!

		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php }
if (isset($_GET['error'])) {
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
}
} ?>

<div class="container bootstrap snippet my-5">
	<h3>Security Question</h3>
	<form action="/securityQuestion" method="post">
		<div class="form-group">
			<select class="form-control" name="question" value="<?php echo $user->security_question ?? ''; ?>">
				<option>What was the house number and street name you lived in as a child?</option>
				<option>What were the last four digits of your childhood telephone number?</option>
				<option>What primary school did you attend?</option>
				<option>In what town or city was your first full time job?</option>
				<option>In what town or city did you meet your spouse/partner?</option>
				<option>What is the middle name of your oldest child?</option>
				<option>What are the last five digits of your driver's licence number?</option>
				<option>What is your grandmother's (on your mother's side) maiden name?</option>
				<option>What is your spouse or partner's mother's maiden name?</option>
				<option>In what town or city did your mother and father meet?</option>
				<option>What time of the day were you born? (hh:mm)</option>
				<option>What time of the day was your first child born? (hh:mm)</option>
			</select>
		</div>

		<div class="form-group">
			<input type="text" class="form-control" placeholder="Answer" value="<?php echo $user->security_question_answer ?? ''; ?>" name="answer" required />
		</div>

		<input type="submit" class="btnSubmit" value="Save">
	</form>
</div>

<?php include_once __DIR__ . '/Layout/Footer.php' ?>