<?php include_once __DIR__ . '/Layout/Header.php' ?>

<div class="container login-container">
	<div class="row">
		<div class="col-md-6 login-form-1">
			<h3>Login</h3>
			<form action="/login" method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Your Username/Email *" value="" />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Your Password *" value="" />
				</div>
				<div class="form-group">
					<input type="submit" class="btnSubmit" value="Login" />
				</div>
				<div class="form-group">
					<a href="#" class="ForgetPwd">Forget Password?</a>
				</div>
			</form>
		</div>
		<div class="col-md-6 login-form-2">
			<h3>Register</h3>
			<form>
				TODO
			</form>
		</div>
	</div>
</div>

<?php include_once __DIR__ . '/Layout/Footer.php' ?>