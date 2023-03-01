<?php
session_start();

include "config.php";

//dapatkan data user dari form
$user = [
	'nip' => $_POST['nip'],
    'nama' => $_POST['nama'],
	'password' => $_POST['password'],
];

//check apakah user dengan username tersebut ada di table users
$query = "select * from users where nip = ? limit 1";

$stmt = $mysqli->stmt_init();

$stmt->prepare($query);

$stmt->bind_param('s', $user['nip']);

$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_array(MYSQLI_ASSOC);

if($row != null){
	//username ditemukan
	//kita cek apakah password dengan hash password sesuai.
	if(password_verify($user['password'], $row['password'])){
		$_SESSION['login'] = true;
		$_SESSION['nip'] =  $user['nip'];
		$_SESSION['nama'] =  $user['nama'];
		$_SESSION['message']  = 'Berhasil login ke dalam sistem.';
		header("Location: http://localhost/grafik/index.php");
	}else{
		$_SESSION['error'] = 'Password anda salah.';
		header("Location: /grafik/login/login.php");
	}

}else{
	$_SESSION['error'] = 'NIP dan password anda tidak ditemukan.';
	header("Location: /grafik/login/login.php");
}

?>