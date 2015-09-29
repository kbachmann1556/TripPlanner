<html>
<head>
	<title>Destination</title>
	<link rel="stylesheet" type="text/css" href="../../stylesheets/materialize/css/materialize.css">
</head>
<body>
	<nav>
		<div class = "nav-wrapper">
			<a href="/travel_dash" class = "left">Home</a>
			<a href="/logout" class = "right">Logout</a>
		</div>
	</nav>
	<div class = "container">
		<div class = "stuff">
		<h1><?= $trip['destination'] ?></h1>
			<p>Planned By: <?= $creator['name']?></p>
			<p>Description: <?= $trip['description'] ?></p>
			<p>Travel Date From: <?= $trip['leave_date'] ?></p>
			<p>Travel Date To: <?= $trip['return_date'] ?></p>
		</div>

		<div class = "other_users">
			<h2>Other users' joining the trip:</h2>
			<?php
			for($i = 0; $i < count($users); $i++)
			{
				?>
				<p><?= $users[$i]['name'] ?></p>
				<?php
			}

			?>
		</div>
	</div>
</body>
</html>