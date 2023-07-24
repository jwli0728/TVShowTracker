<?php

	if(!isset($_GET['id']) || trim($_GET['id']) == '') {
		$error = "Unable to retrieve ID";
	}
	else {
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

		// SQL Query
		$show_id = $_GET["id"];
		$sql = "DELETE FROM watch_list
				WHERE watch_list.id=$show_id;";

		$results = $mysqli->query($sql);
		if (!$results) {
			echo $mysqli->error;
			exit();
		}

		// Close MySQL Connection
		$mysqli->close();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete from List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="header">
		<h1>TV Show Tracker</h1>
	</div> <!-- #header -->

	<!-- <div class="container"> -->
	<div class="container" id="nav-wrapper">
		<div class="row">
			<div class="col"> <a href="index.html">Home</a> </div>
			<div class="col"> <a href="watch_list.php">My Watch List</a> </div>
			<div class="col"> <a href="add_show.php">Add Show</a> </div>
		</div> <!-- .row -->
	</div>
	<!-- </div> -->

	<div class="container" id="main">
		<div class="row">
			<h1 class="col-12 mt-4">Delete a Show from Watch List</h1>
		</div> <!-- .row -->

		<div class="row mt-4">
			<div class="col-12">

				<?php if(isset($error) && trim($error) != ''): ?>

					<div class="text-danger">
						<?php echo($error); ?>
					</div>

				<?php else: ?>

					<div class="text-success"><span class="font-italic"><?php echo($_GET['title'])?></span> has been deleted from your Watch List.</div>

				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="watch_list.php" role="button" class="btn btn-primary">Back to My Watch List</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>
