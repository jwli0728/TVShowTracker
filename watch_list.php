<?php
	// Define Credentials
	$host = "303.itpwebdev.com";
	$user = "jwli_db_user";
	$pass = "USCitp2022";
	$db = "jwli_tv_watch_list";

	// Establish MySQL Conection
	$mysqli = new mysqli($host, $user, $pass, $db);
	// Check for MySQL Connection Errors
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');
	// SQL query
	$sql = "SELECT watch_list.id, watch_list.title, genres.genre, watch_list.release_year, watch_statuses.status
			FROM watch_list
			LEFT JOIN genres
			  ON genres.id = watch_list.genre_id
			LEFT JOIN watch_statuses
			  ON watch_statuses.id = watch_list.current_status_id
			ORDER BY watch_list.current_status_id ASC;";
	$results = $mysqli->query($sql);
	if (!$results) {
		echo $mysqli->error;
		exit();
	}

	$count_sql = "SELECT watch_statuses.status, COUNT(*) AS count
				  FROM watch_list
					  JOIN watch_statuses
						  ON watch_list.current_status_id = watch_statuses.id
				  GROUP BY watch_statuses.status;";
	$count_results = $mysqli->query($count_sql);
  	if (!$count_results) {
  		echo $mysqli->error;
  		exit();
  	}

	// Close MySQL Connection
	$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>My TV Watch List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<style>
		.th {
			color: #A0A1A4;
		}
	</style>
</head>
<body>

	<div class="container" id="header">
		<h1>Watch List</h1>
	</div> <!-- #header -->

	<!-- <div class="container"> -->
	<div class="container" id="nav-wrapper">
		<div class="row">
			<div class="col"> <a href="index.html">Home</a> </div>
			<div class="col"> <a id="active-nav" href="watch_list.php">My Watch List</a> </div>
			<div class="col"> <a href="add_show.php">Add Show</a> </div>
		</div> <!-- .row -->
	</div>
	<!-- </div> -->

	<div class="container" id="main">
		<div class="row">
			<h1 class="col-sm-12 mt-4">My Watch List</h1>
		</div> <!-- .row -->

		<div class="row">
			<div class="col-12 mt-3">

				<table id="show-list" class="table table-hover table-responsive mt-4">
					<tr>
						<th width="200">Title</th>
						<th width="200">Genre</th>
						<th width="200">Release Year</th>
						<th width="200">Watch Status</th>
						<th width="200"></th>
						<th width="200"></th>
					</tr>
					<?php while($row = $results->fetch_assoc()): ?>
						<tr>
							<td> <?php echo $row["title"]; ?></td>
							<td> <?php echo $row["genre"]; ?></td>
							<td> <?php echo $row["release_year"]; ?></td>
							<td> <?php echo $row["status"]; ?></td>
							<td><a href="delete.php?id=<?php echo $row['id']; ?>&title=<?php echo $row['title']; ?>" onclick="return confirm('Are you sure you want to delete this show?');">Delete</td>
							<td><a href="edit_form.php?id=<?php echo $row['id']; ?>">Edit</td>
						</tr>
					<?php endwhile; ?>
				</table>

				<h3 class="col-sm-12 mt-4">Watch List Summary</h1>
				<table>
					<?php while($row = $count_results->fetch_assoc()): ?>
						<tr>
							<td> <?php echo $row["status"]; ?>: </td>
							<td> <?php echo $row["count"]; ?></td>
						</tr>
					<?php endwhile; ?>
				</table>

			</div>
		</div> <!-- .row -->
	</div> <!-- #main -->
</body>
</html>
