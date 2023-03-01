        <div class="form-group">
								<label for="nama_outlet">Nama Outlet</label>
								<select class="form-select" aria-label="Default select example" style="width: 100%;">
									<?php
									include('config.php');
									//query nama outlet
									$query    = mysqli_query($connect, "SELECT * FROM outlet ORDER BY id_outlet");
									while ($data = mysqli_fetch_array($query)) {
									?>
										<option value="<?= $data['nama_outlet']; ?>"><?php echo $data['nama_outlet']; ?></option>
									<?php
									}
									?>
								</select>
							</div>