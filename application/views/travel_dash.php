<html>
<head>
	<title>Travel Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../../stylesheets/materialize/css/materialize.css">
</head>
<body>
	<nav>
		<div class = "nav-wrapper">
			<a class = "left">Hello <?= $user['username'] ?></a>
			<a href="/logout" class = "right hide-on-med-and-down">Logout</a>
		</div>
	</nav>
	

	<div class = "container">
	<?php echo $this->session->flashdata('trip_success'); ?>

	<div class = "user_trips">
		<h4>Your Trip Schedules</h4>
		<table class = "striped">
			<thead>
				<tr>
					<th>Destination</th>
					<th>Travel Start Date</th>
					<th>Travel End Date</th>
					<th>Plans</th>
				</tr>
			</thead>
			<tbody>
				<?php

				for($i = 0; $i < count($user_plans); $i++)
				{
					?>
					<tr>
						<td><a href=<?= '/destination_page/'. $user_plans[$i]['id'] ?>><?= $user_plans[$i]['destination'] ?></a></td>
						<td><?= $user_plans[$i]['leave_date'] ?></td>
						<td><?= $user_plans[$i]['return_date'] ?></td>
						<td><?= $user_plans[$i]['description'] ?></td>
					</tr>
					<?php
				}

				?>
			</tbody>
		</table>
	</div>

	<div class = "others_plans">
		<h4>Other User's Travel Plans</h4>
		<table class = "striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Destination</th>
					<th>Travel Start Date</th>
					<th>Travel End Date</th>
					<th>Do you want to Join?</th>
				</tr>
			</thead>
			<tbody>
				<?php

				for($j = 0; $j < count($other_plans); $j++)
				{
					$count = 0;
					for($k = 0; $k < count($user_plans); $k++)
					{
						if($other_plans[$j]['id'] == $user_plans[$k]['id'])
						{
							$count = 1;
						}
					}
					if($count == 0)
					{
					?>
					<tr>
						<td><?= $other_plans[$j]['name'] ?></td>
						<td><a href=<?= '/destination_page/'. $other_plans[$j]['id'] ?>><?= $other_plans[$j]['destination'] ?></a></td>
						<td><?= $other_plans[$j]['leave_date'] ?></td>
						<td><?= $other_plans[$j]['return_date'] ?></td>
						<td><a href=<?= '/join_trip/'. $other_plans[$j]['id'] ?>>Join</a></td>
					</tr>
					<?php
					}
				}

				?>
			</tbody>
		</table>
	</div>
	<br>
	<a href="/add_plan_page">Add Travel Plan</a>
	</div>
</body>
</html>