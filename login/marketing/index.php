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

<div class="container" style="margin-top: 80px">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					TABLE MARKETING
				</div>
				<div class="card-body">
					<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambah_data"><i class="fa fa-male"></i>Add Data</a><br /><br />
					<!-- modal insert -->
					<div class="example-modal">
						<div id="tambah_data" class="modal fade" role="dialog" style="display:none;">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title fs-">Add Data</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<form action="/grafik/login/marketing/process_marketing.php?act=tambah_data" method="post" role="form">
											<div class="form-group">
												<div class="row">
													<label class="col-sm-3 control-label text-right">Nama Marketing<span class="text-red">*</span></label>
													<div class="col-sm-8">
														<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
														<input type="text" class="form-control" name="nama_marketing" placeholder="Masukkan Nama Marketing" value="">
													</div>
												</div>
											</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-sm-3 control-label text-right"> Nama<br />Outlet<span class="text-red">*</span></label>
											<div class="col-sm-8"><select name="nama_outlet" class="form-select" aria-label="Default select example" style="width: 100%;">
													<?php
													include "config.php";
													//query menampilkan nip pegawai ke dalam combobox
													$query    = mysqli_query($connect, "SELECT * FROM outlet ORDER BY id_outlet");
													while ($data = mysqli_fetch_array($query)) {
													?>
														<option value="<?= $data['nama_outlet']; ?>"><?php echo $data['nama_outlet']; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-sm-3 control-label text-right">Target Jabatan<span class="text-red">*</span></label>
											<div class="col-sm-8"><input type="text" name="target_jabatan" class="form-control" value="" id="" placeholder="Masukkan Target Jabatan"></div>
										</div>
										<div class="form-group">
											<div class="row">
												<label class="col-sm-3 control-label text-right">Target<br />Outlet<span class="text-red">*</span></label>
												<div class="col-sm-8"><input type="text" name="target_outlet" class="form-control" value="" id="" placeholder="Masukkan Target Outlet"></div>
											</div>
											<div class="modal-footer">
												<button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
												<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div><!-- modal insert close -->
						<table class="table table-bordered" id="myTable">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Nama Marketing</th>
									<th scope="col">Outlet</th>
									<th scope="col">Target Marketing</th>
									<th scope="col">Target Outlet</th>
								</tr>
							</thead>
							<tbody>
								<?php
								//menampilkan data pegawai berdasarkan pilihan combobox ke dalam form
								$no = 1;
								$sql = "SELECT * FROM marketing ORDER BY id_marketing";
								$tamData = mysqli_query($connect, $sql);
								while ($tdat = mysqli_fetch_array($tamData)) {
									$id = $tdat['id_marketing'];
									$nama_marketing = $tdat['nama_marketing'];
									$outlet = $tdat['nama_outlet'];
									$target_jabatan = $tdat['target_jabatan'];
									$target_outlet = $tdat['target_outlet'];

								?>

									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $tdat['nama_marketing'] ?></td>
										<td><?php echo $tdat['nama_outlet'] ?></td>
										<td><?php echo $tdat['target_jabatan'] ?></td>
										<td><?php echo $tdat['target_outlet'] ?></td>
										<td>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#my<?php echo $id; ?>">
												Edit<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
											</button>

											<!-- Modal -->
											<div class="example-modal">
												<div class="modal fade" id="my<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h3 class="modal-title" id="myModalLabel">Edit Data</h3>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															</div>
															<div class="modal-body">
																<form action="/grafik/login/marketing/process_edit_marketing.php" method="POST" role="form">
																	<div class="form-group">
																		<div class="row">
																			<label class="col-sm-3 control-label text-right">Nama Marketing<span class="text-red">*</span></label>
																			<div class="col-sm-8">
																			<input type="hidden" name="id_marketing" value="<?php echo $id ?>">	
																			<input type="text" name="nama_marketing" class="form-control" value="<?php echo $nama_marketing ?>"  placeholder="Input field"></div>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="row">
																			<label class="col-sm-3 control-label text-right"> Nama<br />Outlet<span class="text-red">*</span></label>
																			<div class="col-sm-8"><select name="nama_outlet" class="form-select" aria-label="Default select example" style="width: 100%;">
																					<?php
																					include "config.php";
																					//query menampilkan nip pegawai ke dalam combobox
																					$query    = mysqli_query($connect, "SELECT * FROM outlet ORDER BY id_outlet");
																					while ($data = mysqli_fetch_array($query)) {
																					?>
																						<option value="<?= $data['nama_outlet']; ?>"><?php echo $data['nama_outlet']; ?></option>
																					<?php
																					}
																					?>
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="row">
																			<label class="col-sm-3 control-label text-right">Target Jabatan<span class="text-red">*</span></label>
																			<div class="col-sm-8"><input type="text" name="target_jabatan" class="form-control" value="<?php echo $target_jabatan ?>"  placeholder="Masukkan Target Jabatan"></div>
																		</div>
																		<div class="form-group">
																			<div class="row">
																				<label class="col-sm-3 control-label text-right">Target<br />Outlet<span class="text-red">*</span></label>
																				<div class="col-sm-8"><input type="text" name="target_outlet" class="form-control" value="<?php echo $target_outlet ?>"  placeholder="Masukkan Target Outlet"></div>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			<input type="submit" name="update" value="Update" class="btn btn-primary">
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>

								<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
		</script>


		</body>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

		</html>