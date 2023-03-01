<?php
session_start();

include "config.php";

//dapatkan data user dari form register
$user = [
	'id' => $_POST['id'],
	'nama' => $_POST['nama'],
	'nip' => $_POST['nip'],
	'email' => $_POST['email'],
	'password' => $_POST['password'],
	'password_confirmation' => $_POST['password_confirmation'],
];

//validasi jika password & password_confirmation sama

if($user['password'] != $user['password_confirmation']){
	$_SESSION['error'] = 'Password yang anda masukkan tidak sama dengan password confirmation.';
	$_SESSION['id'] = $_POST['id'];
	$_SESSION['nama'] = $_POST['nama'];
	$_SESSION['nip'] = $_POST['nip'];
	$_SESSION['email'] = $_POST['email'];
	header("Location: /grafik/login/register.php");
	return;
}

//check apakah user dengan username tersebut ada di table users
$query = "select * from users where nip = ? limit 1";
$stmt = $mysqli->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('s', $user['nip']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_ASSOC);

//jika username sudah ada, maka return kembali ke halaman register.
if($row != null){
	$_SESSION['error'] = 'NIP: '.$user['nip'].' yang anda masukkan sudah ada di database.';
	$_SESSION['id'] = $_POST['id'];
	$_SESSION['nama'] = $_POST['nama'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['password_confirmation'] = $_POST['password_confirmation'];
	header("Location: /grafik/login/register.php");
	return;

}else{
	//hash password
	$password = password_hash($user['password'],PASSWORD_DEFAULT);

	//username unik. simpan di database.
	$query = "insert into users (id, nama, nip, email, password) values  (?,?,?,?,?)";
	$stmt = $mysqli->stmt_init();
	$stmt->prepare($query);
	$stmt->bind_param('sssss',$user['id'], $user['nama'],$user['nip'],$user['email'],$password);
	$stmt->execute();
	$result = $stmt->get_result();
	var_dump($result);

	$_SESSION['message']  = 'Berhasil register ke dalam sistem. Silakan login dengan username dan password yang sudah dibuat.';
	header("Location: /grafik/login/login.php");
}

?>