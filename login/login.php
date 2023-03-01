<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<title>Login & Logout</title>
</head>
<body>
	<div class="container">

		<div class="row">
			<div class="col-md-4 offset-md-4 mt-5">

				<?php
				if(isset($_SESSION['error'])) {
				?>
				<div class="alert alert-warning" role="alert">
				  <?php echo $_SESSION['error']?>
				</div>
				<?php
				}
				?>

				<?php
				if(isset($_SESSION['logout'])) {
				?>
				<div class="alert alert-success" role="alert">
				  <?php echo $_SESSION['logout']?>
				</div>
				<?php
				}
				?>


				<div class="card ">
					<div class="card-title text-center">
						<h1>Login Form</h1>
					</div>
					<div class="card-body">
						<form action="process-login.php" method="post">
							<div class="form-group">
								<label for="nip">NIP</label>
								<input type="text" name="nip" class="form-control" id="nip" aria-describedby="nip" placeholder="nip" autocomplete="off">

							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Password">
							</div>

							<button type="submit" class="btn btn-primary">Submit</button>
						</form>

                        <br>
                        <h4 class="h6 mb-3 font-weight-normal">Don't have account? <a href="/grafik/login/tambah_marketing.php">Sign Up</a></h4>

					</div>
				</div>
			</div>

		</div>

	</div>
</body>
<?php
session_destroy();
?>