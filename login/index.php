<?php

// Start the session
//session_start();

// Check if the user is logged in
//if (!isset($_SESSION["nip"])) {
//  header("Location: /grafik/login/login.php");
//  exit();
//}





?>

<head>
	<!-- Load file CSS Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- Load file library jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Load file library Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Load file library JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">



	<div class="b-example-divider"></div>

	<header class="p-3 mb-3 border-bottom">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
					<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
						<use xlink:href="#bootstrap" />
					</svg>
				</a>

				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<li><a href="./" class="nav-link px-2 link-secondary">BSI Monitoring v1</a></li>
					<li><a href="/grafik/index.php" class="nav-link px-2 link-dark">Tabel Harian</a></li>
					<li><a href="/grafik/tabel_keseluruhan/index.php" class="nav-link px-2 link-dark">Tabel Keseluruhan</a></li>
				</ul>

			</div>
		</div>
	</header>
</head>

<div class="card-body">
	<table class="table table-bordered" id="myTable">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Nama Marketing</th>
				<th scope="col">Outlet</th>
				<th scope="col">Target Jabatan</th>
				<th scope="col">Target Outlet</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include('config.php');


			include('config.php');
			//menampilkan data pegawai berdasarkan pilihan combobox ke dalam form
			$no = 1;
			$sql = "SELECT * FROM marketing";
			$tamData = mysqli_query($connect, $sql);
			while ($data = mysqli_fetch_array($tamData)) {

				$no = 1;
				
			?>



				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $data['nama_marketing']; ?></td>
					<td><?php echo $data['nama_outlet']; ?></td>
					<td><?php echo $data['target_jabatan']; ?></td>
					<td><?php echo $data['target_outlet'] ?></td>
				</tr>

			<?php 
			}
			?>
		</tbody>
		<td colspan="3" align="center"><b>Capacity Plan Total</b></td>
		<td><?php
			error_reporting(error_reporting() & ~E_NOTICE);

			if (empty($total_target)) {
				die("Tidak ada data!");
			} else {
				echo $total_target;
			}
			?>
		</td>

		<td><?php
			error_reporting(error_reporting() & ~E_NOTICE);

			if (empty($total_cair)) {
				die("Tidak ada data!");
			} else {
				echo $total_cair;
			}
			?>
		</td>
		<td><?php
			error_reporting(error_reporting() & ~E_NOTICE);

			if (empty($total_cair)) {
				die("Tidak ada data!");
			} else {
				echo $total_cair;
			}
			?>
		</td>
		<td>-</td>
		<td><?php
			error_reporting(error_reporting() & ~E_NOTICE);

			if (empty($total_cair)) {
				die("Tidak ada data!");
			} else {
				echo $total_cair;
			}
			?>
		</td>
		<td><?php
			error_reporting(error_reporting() & ~E_NOTICE);

			if (empty($total_persen)) {
				die("Tidak ada data!");
			} else {
				echo $total_persen . "%";
			}
			?>
		</td>

	</table>
</div>
</div>
</div>
</div>
<div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>