<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$hp = $_POST['hp'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];

if($_POST['password'] != ""){	
	mysqli_query($koneksi, "update karyawan set karyawan_nama='$nama', karyawan_hp='$hp', karyawan_email='$email', karyawan_password='$password', karyawan_alamat='$alamat', karyawan_jabatan='$jabatan' where karyawan_id='$id'");
}else{
	mysqli_query($koneksi, "update karyawan set karyawan_nama='$nama', karyawan_hp='$hp', karyawan_email='$email', karyawan_alamat='$alamat', karyawan_jabatan='$jabatan' where karyawan_id='$id'");	
}

header("location:karyawan.php");