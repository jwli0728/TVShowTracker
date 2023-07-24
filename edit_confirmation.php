<?php
	if(!isset($_POST['title']) || trim($_POST['title']) == '' ||
	   !isset($_POST['genre_id']) || trim($_POST['genre_id']) == '' ||
	   !isset($_POST['release_year']) || trim($_POST['release_year']) == '' ||
   	   !isset($_POST['status_id']) || trim($_POST['status_id']) == '') {		//input error
		$error = "Please fill out all required fields.";
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
		$show_id = $_POST['show_id'];
		$title = $_POST['title'];
        $genre_id = $_POST['genre_id'];
        $release_year = $_POST['release_year'];
        $status_id = $_POST['status_id'];

		$sql = "UPDATE watch_list
		 		SET title = '$title',
					genre_id = $genre_id,
                    release_year = $release_year,
                    current_status_id = '$status_id'
				WHERE watch_list.id = $show_id;";

		$result = $mysqli->query($sql);

		if(!$result) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		// Close MySQL Connection
		$mysqli->close();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Confirmation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container" id="header">
		<h1>Edit Confirmation</h1>
	</div> <!-- #header -->
	<div class="container" id="nav-wrapper">
		<div class="row">
			<div class="col"> <a href="index.html">Home</a> </div>
			<div class="col"> <a href="watch_list.php">My Watch List</a> </div>
			<div class="col"> <a href="add_show.php">Add Show</a> </div>
		</div> <!-- .row -->
	</div> <!-- #nav-wrapper -->

	<div class="container" id="main">
		<div class="row">
			<h1 class="col-12 mt-4">Edit Watch List Show</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if(isset($error) && !empty($error)): ?>

					<div class="text-danger font-italic"><?php echo $error; ?></div>

				<?php else: ?>

					<div class="text-success"><span class="font-italic"><?php echo $_POST['title']; ?></span> has been updated.</div>

				<?php endif; ?>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="watch_list.php" role="button" class="btn btn-primary">Go to My Watch List</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>
