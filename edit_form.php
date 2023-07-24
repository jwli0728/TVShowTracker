<?php

	if(!isset($_GET['id']) || empty($_GET['id'])) {
		$error = "Unable to access show ID. Please try again.";
	}
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

	// Retrieve genres options
	$sql_genres = "SELECT * FROM genres;";
	$results_genres = $mysqli->query($sql_genres);
	if ($results_genres == false) {
		echo $mysqli->error;
		exit();
	}

	// Retrieve status options
	$sql_statuses = "SELECT * FROM watch_statuses;";
	$results_statuses = $mysqli->query($sql_statuses);
	if ($results_statuses == false) {
		echo $mysqli->error;
		exit();
	}

	$show_id = $_GET["id"];
	$sql_show = "SELECT *
                 FROM watch_list
				 WHERE watch_list.id = $show_id;";
	$results_show = $mysqli->query($sql_show);
	$row_show = $results_show->fetch_assoc();

	// Close MySQL Connection
	$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Show</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
	<style>
		/* .form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		} */
	</style>
</head>
<body>

    <div class="container" id="nav-wrapper">
		<div class="row">
			<div class="col"> <a href="index.html">Home</a> </div>
			<div class="col"> <a href="watch_list.php">My Watch List</a> </div>
			<div class="col"> <a href="add_show.php">Add Show</a> </div>
		</div> <!-- .row -->
	</div> <!-- #nav-wrapper -->

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Edit Show</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
        <?php if(isset($error) && trim($error) != ''): ?>
			<div class="col-12 text-danger">
				<?php echo($error); ?>
			</div>
		<?php else: ?>

			<form action="edit_confirmation.php" method="POST">
				<!-- invisible input field to feed through POST -->
				<input type="hidden" name="show_id" value="<?php echo $show_id; ?>">

				<div class="form-group row">
					<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Title: <span class="text-danger">*</span></label>
					<div class="col-9">
						<input type="text" class="form-control" id="title-id" name="title" value="<?php echo $row_show["title"]; ?>">
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre: <span class="text-danger">*</span></label>
					<div class="col-9">
						<select name="genre_id" id="genre-id" class="form-control">
							<option value="" selected disabled>-- Select One --</option>
							<?php while( $row = $results_genres->fetch_assoc() ): ?>
								<?php if($row["id"] == $row_show["genre_id"]): ?>
									<option value="<?php echo $row['id']; ?>" selected>
										<?php echo $row['genre']; ?>
									</option>
								<?php else: ?>
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['genre']; ?>
									</option>
								<?php endif; ?>

							<?php endwhile; ?>

						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="release-year-id" class="col-sm-3 col-form-label text-sm-right">Release Year: <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<input type="number" class="form-control" id="release-year-id" name="release_year" value="<?php echo $row_show["release_year"]; ?>">
					</div>
				</div> <!-- .form-group -->
                <div class="form-group row">
					<div class="ml-auto col-sm-9">
						<span class="text-danger font-italic">* 1901-2022</span>
					</div>
				</div> <!-- .form-group -->

                <div class="form-group row">
					<label for="status-id" class="col-sm-3 col-form-label text-sm-right">Watch Status: <span class="text-danger">*</span></label>
					<div class="col-9">
						<select name="status_id" id="status-id" class="form-control">
							<option value="" selected disabled>-- Select One --</option>
							<?php while( $row = $results_statuses->fetch_assoc() ): ?>
								<?php if($row["id"] == $row_show["current_status_id"]): ?>
									<option value="<?php echo $row['id']; ?>" selected>
										<?php echo $row['status']; ?>
									</option>
								<?php else: ?>
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['status']; ?>
									</option>
								<?php endif; ?>

							<?php endwhile; ?>

						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-light">Reset</button>
					</div>
				</div> <!-- .form-group -->

			</form>
		<?php endif; ?>

	</div> <!-- .container -->
</body>
</html>
