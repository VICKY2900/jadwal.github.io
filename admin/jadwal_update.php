<?php 
include '../koneksi.php';

$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];
$karyawan = $_POST['karyawan'];
$shift = $_POST['shift'];
$divisi = $_POST['divisi'];
$penugasan = $_POST['penugasan'];

for($i = 0; $i < count($karyawan); $i++){
	$id_karyawan = $karyawan[$i];
	// echo $id_karyawan."<br>";
	
	mysqli_query($koneksi, "delete from jadwal where jadwal_karyawan='$id_karyawan' and jadwal_bulan='$bulan' and jadwal_tahun='$tahun'");

	for($j = 0; $j < count($shift[$id_karyawan]); $j++){
		
		$day = $j+1;
		$s = $shift[$id_karyawan][$j];
		$d = $divisi[$id_karyawan][$j];
		$pe = $penugasan[$id_karyawan][$j];
		
		mysqli_query($koneksi, "insert into jadwal values(NULL,'$id_karyawan','$tahun','$bulan','$day','$s','$d','$pe')")or die(mysqli_errno($koneksi));

	}
}

header("location:jadwal.php?tahun=$tahun&bulan=$bulan&alert=update");