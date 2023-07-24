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

	// Retrieve genre options
	$sql_genres = "SELECT * FROM genres;";
	$results_genres = $mysqli->query($sql_genres);
	if ($results_genres == false) {
		echo $mysqli->error;
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add to Watch List</title>
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
	<div class="container" id="header">
		<h1>Add to My Watch List</h1>
	</div> <!-- .container -->

	<div class="container" id="nav-wrapper">
		<div class="row">
			<div class="col"> <a href="index.html">Home</a> </div>
			<div class="col"> <a href="watch_list.php">My Watch List</a> </div>
			<div class="col"> <a id="active-nav" href="add_show.php">Add Show</a> </div>
		</div> <!-- .row -->
	</div> <!-- #nav-wrapper -->

	<div class="container" id="main">
		<form action="add_confirmation.php" method="POST">
			<div class="form-group row">
				<label for="title-id" class="col-3 col-form-label text-sm-right">Title: <span class="text-danger">*</span></label>
				<div class="col-9">
					<input type="text" class="form-control" id="title-id" name="title">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="genre_id" id="genre-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<!-- PHP Output Here -->
						<?php while( $row = $results_genres->fetch_assoc() ): ?>

							<option value="<?php echo $row['id']; ?>">
								<?php
									echo $row['genre'];
								?>
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="release-year-id" class="col-3 col-form-label text-sm-right">Release Year: <span class="text-danger">*</span></label>
				<div class="col-9">
					<input type="number" min="1900" max="2022" class="form-control" id="release-year-id" name="release_year">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* 1901-2022</span>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-3"></div>
				<div class="col-9 mt-2">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->

		</form>

	</div> <!-- .container -->
</body>
</html>
