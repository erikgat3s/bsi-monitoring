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

<form method="post" action="">
  <label for="bulan">Select Month:</label>
  <select onchange="this.form.submit();" class="form-select" id="bulan" name="bulan">
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
  <div class="d-grid gap-2">
    <input class="btn btn-outline-primary" type="submit" name="submit" value="Filter">
  </div>
</form>

<div class="card-body">
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th scope="col">Rank.</th>
        <th scope="col">Nama Marketing</th>
        <th scope="col">Outlet</th>
        <th scope="col">Target Jabatan</th>
        <th scope="col">Total Cair</th>
        <th scope="col">Pencairan Baru</th>
        <th scope="col">Pencairan TopUp</th>
        <th scope="col">Total Pencairan Growth</th>
        <th scope="col">%</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include('config.php');
      if (isset($_POST['submit'])) {
        $month = $_POST['bulan'];
        $sql = "SELECT
    tb_harian.nama,
    tb_harian.tanggal as tanggal,
    marketing.nama_outlet,
    SUM(tb_harian.realisasi_cair) as sum_realisasi,
    SUM(tb_harian.total_topup) as sum_topup,
    marketing.target_jabatan,
    FORMAT((SUM(tb_harian.realisasi_cair) + SUM(tb_harian.total_topup)) / marketing.target_jabatan * 100, 2) as percent,
    FORMAT(SUM(tb_harian.realisasi_cair) + SUM(tb_harian.total_topup), 2) as total_cair
  FROM tb_harian
  JOIN marketing ON tb_harian.nama = marketing.nama_marketing
  WHERE MONTH(tanggal) = $month 
  GROUP BY tb_harian.nama
  ORDER BY percent DESC";
      } else {
        $sql = "SELECT
    tb_harian.nama,
    tb_harian.tanggal as tanggal,
    marketing.nama_outlet,
    SUM(tb_harian.realisasi_cair) as sum_realisasi,
    SUM(tb_harian.total_topup) as sum_topup,
    SUM(tb_harian.realisasi_cair) + SUM(tb_harian.total_topup) as ttl_cair,
    marketing.target_jabatan,
    FORMAT((SUM(tb_harian.realisasi_cair) + SUM(tb_harian.total_topup)) / marketing.target_jabatan * 100, 2) as percent,
    FORMAT(SUM(tb_harian.realisasi_cair) + SUM(tb_harian.total_topup), 2) as total_cair
  FROM tb_harian
  JOIN marketing ON tb_harian.nama = marketing.nama_marketing
  WHERE MONTH(tanggal) = MONTH(CURRENT_DATE()) 
  GROUP BY tb_harian.nama
  ORDER BY ttl_cair DESC";
      }

      $no = 1;
      $realisasi = [];
      $total_cair = 0;
      $targetmarketing = [];
      $total_target = 0;
      $persen = [];
      $total_persen = 0;
      $tamData = mysqli_query($conn, $sql);
      while ($data = mysqli_fetch_array($tamData)) {
        $realisasi[] = $data['sum_realisasi'] + $data['sum_topup'];
        $total_cair = array_sum($realisasi);
        $targetmarketing[] = $data['target_jabatan'];
        $total_target = array_sum($targetmarketing);
        $persen[] = $data['percent'];
        $total_persen = array_sum($persen);
        $hasilrealisasi[] = $data['sum_realisasi'];
        $pencairan_baru = array_sum($hasilrealisasi);
        $hasiltopup[] = $data['sum_topup'];
        $topup_total = array_sum($hasiltopup);

      ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $data['nama']; ?></td>
          <td><?php echo $data['nama_outlet']; ?></td>
          <td><?php echo $data['target_jabatan']; ?></td>
          <td><?php echo $data['sum_realisasi'] + $data['sum_topup'] ?></td>
          <td><?php echo $data['sum_realisasi'] ?></td>
          <td><?php echo $data['sum_topup'] ?></td>
          <td><?php echo $data['sum_realisasi'] + $data['sum_topup'] ?></td>
          <td><?php echo $data['percent'] ?>%</td>
        </tr>
      <?php } ?>

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

        if (empty($pencairan_baru)) {
          die("Tidak ada data!");
        } else {
          echo $pencairan_baru;
        }
        ?>
    </td>
    <td><?php
        error_reporting(error_reporting() & ~E_NOTICE);

        if (empty($topup_total)) {
          die("Tidak ada data!");
        } else {
          echo $topup_total;
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

        if (($total_persen) == 0) {
          die("0");
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