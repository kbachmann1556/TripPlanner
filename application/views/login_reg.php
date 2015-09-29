<html>
<head>
	<title>Login/Registration</title>
	<link rel="stylesheet" type="text/css" href="../../stylesheets/materialize/css/materialize.css">
</head>
<body>
	<nav>
	<div class = "nav-wrapper">
		<p class = "Bold-Italic">Trip Planner</p>
	</div>
	</nav>
	<div class = "container">
	<h2>Welcome!</h2>
	<div class = "row">
		<div class = "col s6">
			<div class = "register">
				<?php echo validation_errors();
				echo $this->session->flashdata('register_success');
				?>
				<h4>Register</h4>
				<form action = "register" method = "post">
					<p>Name: <input type = "text" name = "name"></p>
					<p>Username: <input type = "text" name = "username"></p>
					<p>Password:  <input type = "password" name = "password"></p>
					<p>*Password should be at least 8 characters</p>
					<p>Confirm Password:  <input type = "password" name = "confirm_password"></p>
					<input type = "submit" value = "Register">
				</form>
			</div>
		</div>
		<div class = "col s6">
			<div class = "login">
				<?php echo $this->session->flashdata('login_error'); ?>
				<h4>Login</h4>
				<form action = "login" method = "post">
					<p>Username: <input type = "text" name = "username"></p>
					<p>Password:  <input type = "password" name = "password"></p>
					<input type = "submit" value = "Login">
				</form>
			</div>
		</div>
	</div>
	</div>
</body>
</html>