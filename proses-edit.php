<?php

include "config.php";

$query    =mysqli_query($connect, "SELECT * FROM marketing ORDER BY id_marketing");
$data = mysqli_fetch_array($query);

$varname = $data['nama_marketing'];

if (isset($_POST['update'])) {
  $id= $_POST['id'];
  $tanggal= $_POST['tanggal'];
  $realisasi_cair= $_POST['realisasi_cair'];
  $total_topup= $_POST['total_topup'];
  $nama= $_POST['nama'];

  $varname = $_POST['nama'];

  //query
  $querytambah =  mysqli_query($connect, "UPDATE tb_harian set id='$id',tanggal='$tanggal', realisasi_cair='$realisasi_cair', total_topup='$total_topup', nama='$nama' where id='$id'" );

  if ($querytambah) {
      # Code Redirect menggunakan variabel name
      header("location: /grafik/index.php?nama=" . $varname);
  }
  else{
      echo "ERROR, tidak berhasil". mysqli_error($connect);
  }
}

?>