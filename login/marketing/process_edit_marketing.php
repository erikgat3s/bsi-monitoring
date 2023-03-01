<?php

include "config.php";

if (isset($_POST['update'])) {
  $id= $_POST['id_marketing'];
  $nama= $_POST['nama_marketing'];
  $outlet= $_POST['nama_outlet'];
  $target_jabatan= $_POST['target_jabatan'];
  $target_outlet= $_POST['target_outlet'];


  //query
  $querytambah =  mysqli_query($connect, "UPDATE marketing set id_marketing='$id', nama_marketing='$nama', nama_outlet='$outlet', target_jabatan='$target_jabatan', target_outlet='$target_outlet' where id_marketing='$id'" );

  if ($querytambah) {
      # Code Redirect menggunakan variabel name
      header("location: /grafik/login/marketing");
  }
  else{
      echo "ERROR, tidak berhasil". mysqli_error($connect);
  }
}

?>