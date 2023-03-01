<?php

include "config.php";

$query    =mysqli_query($connect, "SELECT * FROM marketing ORDER BY id_marketing");
$data = mysqli_fetch_array($query);



if($_GET['act'] == 'tambah_data'){
  $id = $_POST['id'];
  $nama = $_POST['nama_marketing'];
  $outlet = $_POST['nama_outlet'];
  $target_jabatan = $_POST['target_jabatan'];
  $target_outlet = $_POST['target_outlet'];

  $varname = $_POST['nama'];

  //query
  $querytambah =  mysqli_query($connect, "INSERT INTO marketing (id_marketing, nama_marketing, nama_outlet, target_jabatan, target_outlet) VALUES('$id' , '$nama' , '$outlet' , '$target_jabatan', '$target_outlet')");

  if ($querytambah) {
      # Code Redirect menggunakan variabel name
      header("location: /grafik/login/marketing");
  }
  else{
      echo "ERROR, tidak berhasil". mysqli_error($connect);
  }
}

?>