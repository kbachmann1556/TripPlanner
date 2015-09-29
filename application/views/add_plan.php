<html>
<head>
	<title>Add Plan</title>
	<link rel="stylesheet" type="text/css" href="../../stylesheets/materialize/css/materialize.css">
</head>
<body>
	<nav>
		<div class = "nav-wrapper">
			<a href="/travel_dash" class = 'left'>Home</a>
			<a href="/logout" class= 'right'>Logout</a>
		</div>
	</nav>
	<div class = 'container'>
		<h1>Add a Trip</h1>
		<?php echo validation_errors();
		echo $this->session->flashdata("date_error");
		 ?>
		<form action = "add_trip" method = "post">
			<div class = "row">
				<div class = "col s6">
					<p>Destination: <input type = "text" name = "destination"></p>
				</div>
				<div class = "col s6">
					<p>Description: <input type = "text" name = "description"></p>
				</div>
			</div>
			<div class = "row">
				<div class = "col s6">
					<p>Travel Date From: <input type = "text" name = "leave_date"> (mm/dd/yyyy format)</p>
				</div>
				<div class = "col s6">
					<p>Travel Date To: <input type = "text" name = "return_date"> (mm/dd/yyyy format)</p>
				</div>
			</div>
			<input type = "hidden" name = "created_by" value = <?= $user['id'] ?>>
			<input type = "submit" value = "Add">
		</form>
	</div>
</body>
</html>