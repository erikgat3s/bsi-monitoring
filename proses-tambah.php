<?php

include "config.php";

$query    =mysqli_query($connect, "SELECT * FROM marketing ORDER BY id_marketing");
$data = mysqli_fetch_array($query);



if($_GET['act'] == 'tambah_data'){
  $id = $_POST['id'];
  $tanggal = $_POST['tanggal'];
  $realisasi_cair = $_POST['realisasi_cair'];
  $total_topup = $_POST['total_topup'];
  $nama = $_POST['nama'];

  $varname = $_POST['nama'];

  //query
  $querytambah =  mysqli_query($connect, "INSERT INTO tb_harian (id, tanggal, realisasi_cair, total_topup, nama) VALUES('$id' , '$tanggal' , '$realisasi_cair' , '$total_topup', '$nama')");

  if ($querytambah) {
      # Code Redirect menggunakan variabel name
      header("location: /grafik/index.php?nama=" . $varname);
  }
  else{
      echo "ERROR, tidak berhasil". mysqli_error($connect);
  }
}

?>