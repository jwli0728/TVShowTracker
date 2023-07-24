<!-- b56859e2032acf6d64c764eaf68ded9620000511219ad55bd0e3aebc04acd1ed -->
<!DOCTYPE html>
<html>
<head>
	<title>My TV Watch List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<style>
		/* stuff */
	</style>
</head>
<body>
	<div class="container" id="header">
		<h1>Search Results</h1>
	</div> <!-- #header -->
	<div class="container" id="nav-wrapper">
		<div class="row">
			<div class="col"> <a id="active-nav" href="index.html">Home</a> </div>
			<div class="col"> <a href="watch_list.php">My Watch List</a> </div>
			<div class="col"> <a href="add_show.php">Add Show</a> </div>
		</div> <!-- .row -->
	</div> <!-- #nav-wrapper -->
	<div class="container" id="main">
		<div class="row">
			<h1 class="col-sm-12 mt-4">Find TV Shows</h1>
		</div> <!-- .row -->

		<div class="row">
			<div class="col-12 mt-3">

				<table id="show-list" class="table table-hover table-responsive mt-4">
					<tr>
                        <th width="200">Poster</th>
						<th width="200">Title</th>
						<th width="200">Release Year</th>
						<th width="200">Rank</th>
					</tr>
				</table>
			</div>
		</div> <!-- .row -->
	</div> <!-- #main -->
	<script>
		for (let i = 0; i < 4; i++) {
			createRow();
		}

		function createRow(){
			var tr = document.createElement('tr');
			var tdImage = document.createElement('td');
			var showImage = document.createElement('img');
			var tdTitle = document.createElement('td');
			var tdDate = document.createElement('td');
			var tdRank = document.createElement('td');

			showImage.src = "https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930";
			showImage.alt = "invalid poster image";
			showImage.classList.add("show-pic");

			tdImage.appendChild(showImage);
			tdTitle.innerHTML = "title";
			tdDate.innerHTML = "year";
			tdRank.innerHTML = "N/A";

			tr.appendChild(tdImage);
			tr.appendChild(tdTitle);
			tr.appendChild(tdDate);
			tr.appendChild(tdRank);

			document.querySelector('#show-list').appendChild(tr);
		}
	</script>

</body>
</html>
