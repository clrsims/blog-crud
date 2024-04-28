<!--MAKE A DELETE TOOL-->

<?php

    //Establish DB connection
	$host = "303.itpwebdev.com";
	$user = "clsims_db_user";
	$pass = "csNGNG1156";
	$db = "clsims_blog";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	// Posts
	$sql_posts = "SELECT * FROM posts;";
	$results_posts = $mysqli->query($sql_posts);
	if ($results_posts == false) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Categories
	$sql_categories = "SELECT * FROM categories;";
	$results_categories = $mysqli->query($sql_categories);
	if ($results_categories == false) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Authors
	$sql_authors = "SELECT * FROM authors;";
	$results_authors = $mysqli->query($sql_authors);
	if ($results_authors == false) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="My own personal twitter, complete with a search tool, create tool, and delete tool for me to manage my posts directly on the website. Come here to take a look at my random thoughts!">
		<title>BLOG -- Christopher Sims</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="styles.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="icon" href="img/CS.png" type="image/png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
	</head>

	<body>

		<!--Header-->
		<div class="container text-content header">
			<div class = "row mt-2">
				<div class="col-4 name"><a href="Sims_Christopher_Resume.pdf" id="resume"  download target="_blank">Christopher Sims</a></div>
				<div class="col heading"><a href="about.html">.about()</a></div>
				<div class="col heading"><a href="work.php">.work()</a></div>
				<div class="col heading"><a href="blog.php">.blog()</a></div>
				<div class="col-2 heading d-flex justify-content-around">
					<a href="https://www.linkedin.com/in/christopherleesims/" target="_blank"><i class="bi bi-linkedin"></i></a>
					<a href="https://github.com/clrsims?tab=projects" target="_blank"><i class="bi bi-github"></i></a>
					<a href="https://www.instagram.com/chrislrsims/" target="_blank"><i class="bi bi-instagram"></i></a>
				</div>
			</div>
		</div>

		<!--BLOG-->
		<div class="container small-padding">


			<div class="row mb-3">
				<div class="col-12 d-flex justify-content-between">
					<span class="blog-title">My Posts</span>
					<span class="search-title">Search Tool</span>
				</div>
			</div>

			
			<div class="row d-flex justify-content-between">
				
				<div class="col-7 mt-3">

					<?php
						$sql = "SELECT p.title, p.date, p.image_url, p.content, c.category FROM posts p JOIN categories c ON p.category_id = c.category_id WHERE 1=1";

						// SEARCH FOR A POST
						// from_date, to_date, title, category_id
						if ($_SERVER['REQUEST_METHOD'] == 'GET') {
							
							if (isset($_GET['title']) && !empty($_GET['title'])) {
								$title = $_GET['title'];
								$sql = $sql . " AND p.title LIKE '$title'";
							}

							if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
								$category_id = $_GET['category_id'];
								$sql = $sql . " AND p.category_id = $category_id";
							}

							if (isset($_GET['from-date']) && !empty($_GET['from-date'])) {
								$from_date = $_GET['from-date'];
								$sql = $sql . " AND p.date >= '$from_date'";
							}

							if (isset($_GET['to-date']) && !empty($_GET['to-date'])) {
								$to_date = $_GET['to-date'];
								$sql = $sql . " AND p.date <= '$to_date'";
							}
				
						}

						$sql = $sql . " ORDER BY p.date DESC;";

						$result = $mysqli->query($sql);
						if (!$result) {
							echo "SQL error: " . $mysqli->error;
							exit();
						}


						/*

							Things we need to know for pagination:
								1. start index for 'LIMIT' SQL clause
								2. count or # of results per page for LIMIT SQL clause
								3. current page number
								
						*/

						$total_results = $result->num_rows;
						$results_per_page = 5;
						$last_page = ceil($total_results/$results_per_page);
				

						if (isset($_GET['page']) && trim($_GET['page']) != '') {
							$current_page = $_GET['page'];
						} else {
							$current_page = 1;
						}

						if ($current_page < 1 || $current_page > $last_page) {
							$current_page = 1;
						}

						$start_index = ($current_page - 1) * $results_per_page;

						$sql = rtrim($sql, ';');

						$sql = $sql . " LIMIT $start_index, $results_per_page;";

						$result = $mysqli->query($sql);
						if (!$result) {
							echo $mysqli->error;
							$mysqli->close();
							exit();
						}


						while ($row = $result->fetch_assoc()) {
							$image_url = !empty($row['image_url']) ? $row['image_url'] : 'img/black.jpg';
							echo '<div class="blog-post">';
							echo '	<div class="row">';
							echo '    <div class="col-3">';
							echo '        <img src="' . htmlspecialchars($image_url) . '" alt="' . htmlspecialchars($row['title']) . '" class="blog-picture img-fluid">';
							echo '    </div>';
							echo '    <div class="col-7 pt-2">';
							echo '        <span class="blog-subtitle">' . htmlspecialchars($row['title']) . '</span>';
							echo '        <span class="spacer"></span>';
							echo '        <span class="blog-subtitle">' . htmlspecialchars($row['date']) . '</span>';
							echo '        <span class="spacer"></span>';
							echo '        <span class="blog-subtitle">' . htmlspecialchars($row['category']) . '</span>';
							echo '    </div>';
							echo '  </div>';
							

							echo '	<div class="row">';
							echo '    	<div class="col-11 blog-content">' . nl2br(htmlspecialchars($row['content'])) . '</div>';
							echo '	</div>';

							echo '</div>';
						}

					?>
					
					


				</div>




				<div class="col-4">

					<!--SEARCH TOOL-->
					<div class="row search">
						<div class="container">
							<form action="blog.php" method="GET">

								<!--Title Group-->
								<div class="form-group search-group row">
									<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Title: </label>
									<div class="col-sm-7">
										<input type="text" class="search-text" id="title-id" name="title">
									</div>
								</div>

								<!--Category Group-->
								<div class="form-group search-group row">
									<label for="category-id" class="col-sm-3 col-form-label text-sm-right">Category:</label>
									<div class="col-sm-9">
										<select name="category_id" class="search-select" id="category_id">
											<option value="" selected>-- All --</option>

												<?php while ($row = $results_categories->fetch_assoc()) : ?>
													<option value='<?php echo $row['category_id'] ?>'>
														<?php echo $row['category'] ?>
													</option>
												<?php endwhile; ?>
					
											
					
										</select>
									</div>
								</div>

								<!--Date Group-->
								<div class="form-group search-group row">
									<label class="col-sm-3 col-form-label text-sm-right">Release Date:</label>
									<div class="col-sm-8">
										<div class="row">
											<div class="col">
												<label class="form-check-label my-1">
													From:
													<input type="date" class="mt-2 search-date" id="from-date-id" name="from-date">
												</label>
											</div> <!--col-->

											<div class="spacer"></div>

											<div class="col">
												<label class="form-check-label my-1">
													to: 
													<input type="date" class="mt-2 search-date" name="to-date">
												</label>
											</div> <!-- .col -->
										</div>
									</div>
								</div>



								<div class="form-group row">
									<div class="col-sm-3"></div>
									<div class="col-sm-9 mt-2">
										<button class="submit-button" type="submit">Search</button>
										<button class="delete-button" type="reset">Reset</button>
									</div>
								</div> <!-- .form-group -->
							</form>
						</div>
					</div>



					<!--CREATE TOOL-->
					<div class="row create-margins">
						<span class="create-title">Create Tool</span>
						<div class="text-content create">
							<div class="container">
								<form action="blog.php" method="POST">

									<!--Password-->
									<div class="form-group row mt-2">
										<label for="password" class="col-sm-3 col-form-label text-sm-right">Password:</label>
										<div class="col-sm-9">
											<input type="password" class="create-password" id="password" name="password">
										</div>
									</div>

									<!--Title-->
									<div class="form-group row">
										<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Title: </label>
										<div class="col-sm-9">
											<input type="text" class="create-text" id="title-id" name="title">
										</div>
									</div>

									<!--Date-->
									<div class="form-group row">
										<label for="date-id" class="col-sm-3 col-form-label text-sm-right">Date:</label>
										<div class="col-sm-9">
											<input type="date" class="create-date" id="date" name="date">
										</div>
									</div>
									<!--Date will always be current date, so find a way to reflect that-->

									<!--Image URL-->
									<div class="form-group row">
										<label for="image_url" class="col-sm-3 col-form-label text-sm-right">Image URL:</label>
										<div class="col-sm-9">
											<input type="text" class="create-text" id="image_url" name="image_url">
										</div>
									</div> <!-- .form-group -->

									<!--Content-->
									<div class="form-group row">
										<label for="content-id" class="col-sm-3 col-form-label text-sm-right">Content: </label>
										<div class="col-sm-9">
											<textarea class="create-text" id="content" name="content" rows="5"></textarea>
										</div>
									</div>

									<!--Category-->
									<div class="form-group row">
										<label for="category_id" class="col-sm-3 col-form-label text-sm-right">Category:</label>
										<div class="col-sm-9">

											<select name="category_id" id="category_id" class="create-select">
												<option value="" selected disabled>-- Select One --</option>

													<?php mysqli_data_seek($results_categories, 0) ?>

													<?php while ($row = $results_categories->fetch_assoc()) : ?>
														<option value='<?php echo $row['category_id'] ?>'>
															<?php echo $row['category'] ?>
														</option>
													<?php endwhile; ?>
											</select>

										</div>
									</div>

									<!--Submit & Reset-->
									<div class="form-group row">
										<div class="col-sm-3"></div>
										<div class="col-sm-9 button-margins">
											<button class="submit-button" type="submit">Submit</button>
											<button class="delete-button" type="reset">Reset</button>
										</div>
									</div> 

								</form>
							</div>
						</div>
					</div> <!--Create Tool-->


					<!-- Delete Tool -->
					<div class="row create-margins">
						<span class="delete-title">Delete Tool</span>
						<div class="text-content delete">

							<div class="container">
								<form action="blog.php" method="POST">

									<!--Password-->
									<div class="form-group row mt-2">
										<label for="password" class="col-sm-3 col-form-label text-sm-right">Password:</label>
										<div class="col-sm-9 d-flex justify-content-center">
											<input type="password" class="delete-text" id="delete-password" name="delete-password">
										</div>
									</div>

									<!--Title-->
									<div class="form-group row">
										<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Title: </label>
										<div class="col-sm-9 d-flex justify-content-center">
											<input type="text" class="delete-text" id="delete-title-id" name="delete-title">
										</div>
									</div>

									<!--Submit & Reset-->
									<div class="form-group row">
										<div class="col-sm-3"></div>
										<div class="col-sm-9 button-margins d-flex justify-content center">
											<button class="delete-button" type='submit' onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
										</div>
									</div> 

								</form>
							</div>

						</div>
					</div> 







				</div>



			</div>


			<!--PAGINATION-->
			<div class="row">

				<div class="col-12 form-text">
					Showing 
					<?php echo $start_index + 1; ?>
					-
					<?php echo $start_index + $result->num_rows; ?>
					of 
					<?php echo $total_results; ?>
					result(s).
				</div>

				<div class="col-12 bottom-margins">
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">

							<li class="page-item <?php 
								if ($current_page <= 1) {
									echo "disabled";
								}
							?>">
								<a class="custom-pagination" href="<?php 
									$_GET['page'] = 1;
									echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
								?>">First</a>
							</li>

							<li class="page-item <?php 
								if ($current_page <= 1) {
									echo "disabled";
								}
							?>">
								<a class="custom-pagination" href="<?php 
									$_GET['page'] = $current_page - 1;
									echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
								?>">Previous</a>
							</li>

							<li class="page-item">
								<a class="custom-pagination active2" href="">
									<?php echo $current_page; ?>
								</a>
							</li>

							<li class="page-item <?php 
								if ($current_page >= $last_page) {
									echo "disabled";
								}
							?>">
								<a class="custom-pagination" href="<?php 
									$_GET['page'] = $current_page + 1;
									echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
								?>">Next</a>
							</li>

							<li class="page-item <?php 
								if ($current_page >= $last_page) {
									echo "disabled";
								}
							?>">
								<a class="custom-pagination" href="<?php 
									$_GET['page'] = $last_page;
									echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
								?>">Last</a>
							</li>

						</ul>
					</nav>
				</div>
			</div>





		</div>




		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		<script>

			document.querySelectorAll('.blog-post').forEach(function(element) {
				element.addEventListener('mouseover', function() {
					// Find the closest parent 'container', then find 'change-this' within it
					this.closest('.blog-post').querySelectorAll('.blog-title').forEach(function(changeElement){ 
						changeElement.style.color = '#7722e6';
					});
					this.closest('.blog-post').querySelectorAll('.blog-subtitle').forEach(function(changeElement){ 
						changeElement.style.color = '#7722e6';
					});
					this.closest('.blog-post').querySelectorAll('.blog-content').forEach(function(changeElement){ 
						changeElement.style.color = '#7722e6';
					});
				});


				element.addEventListener('mouseout', function() {
					// Find the closest parent 'container', then find 'change-this' within it
					this.closest('.blog-post').querySelectorAll('.blog-title').forEach(function(changeElement){ 
						changeElement.style.color = '#02d5fa';
					});
					this.closest('.blog-post').querySelectorAll('.blog-subtitle').forEach(function(changeElement){ 
						changeElement.style.color = '#02d5fa';
					});
					this.closest('.blog-post').querySelectorAll('.blog-content').forEach(function(changeElement){ 
						changeElement.style.color = '#02d5fa';
					});
				});
			});


			document.getElementById('resume').addEventListener('click', function(event) {
				if (!confirm('Would you like to download my resume?')) {
					event.preventDefault();
				}
			});

			// adds an active class that selects only the a tag link the window is on
			document.addEventListener("DOMContentLoaded", function() {
				var links = document.querySelectorAll('a');
				var current = window.location.href;

				links.forEach(function(link) {
					if (link.href === current) {
						link.className += ' active';
					}
				});
			});
			
		</script>

		<?php

			$password = hash('sha256', 'csNGNG1156');

			// CREATE A POST
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (isset($_POST['password']) && isset($_POST['title']) && isset($_POST['date']) && isset($_POST['content']) && isset($_POST['category_id'])) {
					if (hash('sha256', $_POST['password']) == $password) {
						$title = $_POST['title'];
						$date = $_POST['date'];
						$image_url = $_POST['image_url'];
						$content = $_POST['content'];
						$category_id = $_POST['category_id'];

						$sql_insert = "INSERT INTO posts (title, date, image_url, content, category_id, author_id) VALUES ('$title', '$date', '$image_url', '$content', $category_id, 1);";
						$results_insert = $mysqli->query($sql_insert);
						if (!$results_insert) {
							echo $mysqli->error;
							exit();
						}
					} else {
						echo "<script>alert('Incorrect password.');</script>";
					}
				} else if (!isset($_POST['delete-title'])) {
					echo "<script>alert('Please fill out all fields.');</script>";
				}

				// DELETE FUNCTIONALITY

				if (isset($_POST['delete-title'])) {
					$delete_title = $_POST['delete-title'];
					$delete_password = hash('sha256', $_POST['delete-password']);
					if ($delete_password == $password) {
						$delete_sql = "DELETE FROM posts WHERE title LIKE '$delete_title'";
						$delete_result = $mysqli->query($delete_sql);
						if (!$delete_result) {
							echo "SQL error: " . $mysqli->error;
							exit();
						} else {
							echo "<script>alert('Post deleted sucessfully.');</script>";
						}
					} else {
						echo "<script>alert('Incorrect password.');</script>";
					}
				}
			}

			$mysqli->close();
		?>

	</body>
    
</html>