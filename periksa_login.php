<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);
$sebagai = $_POST['sebagai'];

if($sebagai == "administrator"){

	$login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='$username' AND user_password='$password'");
	$cek = mysqli_num_rows($login);

	if($cek > 0){
		session_start();
		$data = mysqli_fetch_assoc($login);
		$_SESSION['id'] = $data['user_id'];
		$_SESSION['nama'] = $data['user_nama'];
		$_SESSION['username'] = $data['user_username'];
		$_SESSION['status'] = "administrator_logedin";
		header("location:admin/");
	}else{
		header("location:index.php?alert=gagal");
	}

}elseif($sebagai == "karyawan"){

	$login = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE karyawan_email='$username' AND karyawan_password='$password'");
	$cek = mysqli_num_rows($login);

	if($cek > 0){
		session_start();
		$data = mysqli_fetch_assoc($login);
		$_SESSION['id'] = $data['karyawan_id'];
		$_SESSION['nama'] = $data['karyawan_nama'];
		$_SESSION['status'] = "karyawan_logedin";
		header("location:karyawan/");
	}else{
		header("location:index.php?alert=gagal");
	}
}
