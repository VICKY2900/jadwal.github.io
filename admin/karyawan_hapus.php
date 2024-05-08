<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from karyawan where karyawan_id='$id'");
mysqli_query($koneksi, "delete from jadwal where jadwal_karyawan='$id'");
header("location:karyawan.php");