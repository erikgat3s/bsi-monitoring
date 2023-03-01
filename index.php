<?php

include "config.php";






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
          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
            <select onchange="this.form.submit();" class="form-select" name="nama" aria-label="Default select example">
              <option value="Nama Marketing">Pilih Nama Marketing</option>
              <?php
              include "config.php";
              //query menampilkan nama marketing ke dalam combobox
              $query    = mysqli_query($connect, "SELECT * FROM marketing ORDER BY id_marketing");
              while ($data = mysqli_fetch_array($query)) {
              ?>
                <option value="<?= $data['nama_marketing']; ?>"><?php echo $data['nama_marketing']; ?></option>

              <?php
              }
              ?>
            </select>
        </div>
        </form>

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
                  <form action="/grafik/proses-tambah.php?act=tambah_data" method="post" role="form">
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Date<span class="text-red">*</span></label>
                        <div class="col-sm-8">
                          <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                          <input type="date" class="form-control" name="tanggal" placeholder="tanggal" value="Masukkan tanggal input">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Total Cair<span class="text-red">*</span></label>
                        <div class="col-sm-8"><input type="text" class="form-control" name="realisasi_cair" placeholder="Masukkan Total Cair" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Pencairan Topup<span class="text-red">*</span></label>
                        <div class="col-sm-8"><input type="text" class="form-control" name="total_topup" placeholder="Masukkan Total Pencairan TopUp" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Nama Marketing <span class="text-red">*</span></label>
                        <div class="col-sm-8"><select name="nama" class="form-select" aria-label="Default select example" style="width: 100%;">
                            <?php
                            include "config.php";
                            //query menampilkan nip pegawai ke dalam combobox
                            $query    = mysqli_query($connect, "SELECT * FROM marketing ORDER BY id_marketing");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                              <option value="<?= $data['nama_marketing']; ?>"><?php echo $data['nama_marketing']; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
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
              <th scope="col">NO.</th>
              <th scope="col">Nama</th>
              <th scope="col">Total Cair</th>
              <th scope="col">Total Topup</th>
              <th scope="col">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include('config.php');
            if (isset($_GET['nama'])) {
              $nama = $_GET['nama'];

              //menampilkan data pegawai berdasarkan pilihan combobox ke dalam form
              $no = 1;
              $sql = "SELECT * FROM tb_harian WHERE nama='$nama' ORDER BY nama ASC";
              $tamData = mysqli_query($connect, $sql);

              $total_topup = 0;
              $total_realisasi = 0;

              $total_realisasi_query = mysqli_query($connect, "SELECT SUM(realisasi_cair) as total_realisasi FROM tb_harian WHERE nama='$nama' ORDER BY nama ASC");
              $total_topup_query = mysqli_query($connect, "SELECT SUM(total_topup) as total_topup FROM tb_harian WHERE nama='$nama' ORDER BY nama ASC");

              $total_realisasi_data = mysqli_fetch_array($total_realisasi_query);
              $total_topup_data = mysqli_fetch_array($total_topup_query);

              $total_realisasi = $total_realisasi_data['total_realisasi'];
              $total_topup = $total_topup_data['total_topup'];

              $total_cair_all = $total_realisasi + $total_topup;

              while ($tdat = mysqli_fetch_array($tamData)) {
                $id = $tdat['id'];

                // Your code to display data goes here

            ?>

                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $tdat['nama'] ?></td>
                  <td><?php echo $tdat['realisasi_cair'] ?></td>
                  <td><?php echo $tdat['total_topup'] ?></td>
                  <td><?php echo $tdat['tanggal'] ?></td>
                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#my<?php echo $tdat['id']; ?>">
                      Edit<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </button>

                    <!-- Modal -->
                    <div class="example-modal">
                      <div class="modal fade" id="my<?php echo $tdat['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="myModalLabel">Edit Data</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                              <form action="proses-edit.php" method="POST" role="form">


                                <div class="form-group">

                                  <input type="hidden" name="id" class="form-control" value="<?php echo $tdat['id']; ?>" id="" placeholder="Input field">
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Tanggal<span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="date" name="tanggal" class="form-control" value="<?php echo $tdat['tanggal']; ?>" id="" placeholder="Input field"></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Realisasi Cair<span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" name="realisasi_cair" class="form-control" value="<?php echo $tdat['realisasi_cair']; ?>" id="" placeholder="Input field"></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Pencairan Topup<span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="total_topup" placeholder="Masukkan Total Pencairan TopUp" value="<?= $tdat['total_topup'] ?>"></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Nama Marketing<span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" name="nama" class="form-control" readonly value="<?php echo $tdat['nama']; ?>" id="" placeholder="Input field"></div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>

            <?php }
            }
            ?>
          </tbody>
          <td colspan="2" align="center"><b>JUMLAH</b></td>
          <td><?php

              if (empty($total_realisasi)) {
                die("Tidak ada data!");
              } else {
                echo $total_realisasi;
              }
              ?>
          </td>
          <td><?php

              if (empty($total_topup)) {
                die("Tidak ada data!");
              } else {
                echo $total_topup;
              }
              ?>
          </td>

          <td colspan="1" align="center"><b>Total</b></td>
          <td><?php

              if (empty($total_cair_all)) {
                die("Tidak ada data!");
              } else {
                echo $total_cair_all;
              }
              ?>
          </td>
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