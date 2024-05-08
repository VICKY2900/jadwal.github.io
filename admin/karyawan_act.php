<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$hp  = $_POST['hp'];
$email  = $_POST['email'];
$password  = md5($_POST['password']);
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];

mysqli_query($koneksi, "insert into karyawan values (NULL,'$nama','$hp','$email','$password','$alamat','$jabatan')");
header("location:karyawan.php");