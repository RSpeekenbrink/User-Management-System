<?php include_once __DIR__ . '/Layout/Header.php' ?>

<div class="container login-container">
	<div class="row">
		<div class="col-md-6 login-form-1">
			<h3>Login</h3>
			<form action="/login" method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username/Email" value="" />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" value="" />
				</div>
				<div class="form-group">
					<input type="submit" class="btnSubmit" value="Login" />

					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="remember-me">
						<label class="form-check-label" for="remember-me">Remember Me</label>
					</div>
				</div>
				<div class="form-group">
					<a href="#" class="ForgetPwd">Forgot Password?</a>
				</div>
			</form>
		</div>
		<div class="col-md-6 login-form-2">
			<h3>Register</h3>
			<form action="/register" method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username" value="" />
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email" value="" />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" value="" />
				</div>
				<div class="form-group">
					<input type="submit" class="btnSubmit" value="Register" />
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once __DIR__ . '/Layout/Footer.php' ?>