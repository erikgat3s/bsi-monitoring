<!DOCTYPE html>
<html>
<head>
	<title>Graphs by Month and Year</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
</head>
<body>

	<div class="container-fluid">

		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#month">Graph by Month</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#year">Graph by Year</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div id="month" class="tab-pane active">
				<h3>Graph by Month</h3>
				<form method="post" action="">
					<label for="bulan">Select Month:</label>
					<select id="bulan" name="bulan">
						<option value="">Select Month</option>
						<option value="01">January</option>
						<option value="02">February</option>
						<option value="03">March</option>
						<option value="04">April</option>
						<option value="05">May</option>
						<option value="06">June</option>
						<option value="07">July</option>
						<option value="08">August</option>
						<option value="09">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					</select>
                    
                    <label for="tahun">Select Year:</label>
					<select id="tahun" name="tahun">
						<option value="">Select Year</option>
						<?php
						for ($i = date("Y"); $i >= 2021; $i--) {
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
						?>
					</select>

					<input type="submit" name="submitbulan" value="Filter">
				</form>
				<div id="container-outlet"></div>
			</div>
			<div id="year" class="tab-pane fade">
				<h3>Graph by Year</h3>
				<div id="container-year"></div>
			</div>
		</div>

	</div>

    