<?php
$user = null;

if (isset($_SESSION['user_id'])) {
	$user = App\Models\User::find($_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>User Management System</title>

	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="/">UMS</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php echo $this->request->url() == '/' ? 'active' : ''; ?>">
					<a class="nav-link" href="/">Home</a>
				</li>
			</ul>

			<?php if (!$user) {
				?>
				<div class="form-inline my-2 my-lg-0">
					<a class="btn btn-primary my-2 mr-2 my-sm-0" href="/login">Login</a>
					<a class="btn btn-outline-secondary my-2 my-sm-0" href="/register">Register</a>
				</div>
			<?php } else { ?>
				<div class="form-inline my-2 my-lg-0">
					<a class="my-sm-0 my-2 mr-2" href="/profile"><?php echo $user->username; ?></a>
					<a class="btn btn-outline-secondary my-2 my-sm-0" href="/logout">Logout</a>
				</div>
			<?php } ?>
		</div>
	</nav>