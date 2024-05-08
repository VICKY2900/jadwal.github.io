<?php
// memanggil library FPDF
require('../library/fpdf185/fpdf.php');
include '../koneksi.php'; 

$arr_bulan = array(
  '1' => "Januari",
  '2' => "Februari",
  '3' => "Maret",
  '4' => "April",
  '5' => "Mei",
  '6' => "Juni",
  '7' => "Juli",
  '8' => "Agustus",
  '9' => "September",
  '10' => "Oktober",
  '11' => "November",
  '12' => "Desember"
);

$tahun = $_GET['tahun'];
$bulan = $_GET['bulan'];
$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

session_start();
$id_karyawan = $_SESSION['id'];
$data = mysqli_query($koneksi,"SELECT * FROM karyawan where karyawan_id='$id_karyawan'");
$d = mysqli_fetch_array($data);


// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan



$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7, "JADWAL DINAS PETUGAS IT, LAYANAN MEDIA BARU DAN PEMELIHARAAN PERALATAN" ,0,1,'C'); 


$pdf->Cell(20,4, "" ,0,1,''); 

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,7, "TAHUN" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, $tahun ,0,1,''); 

$pdf->Cell(20,7, "BULAN" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, $arr_bulan[$bulan] ,0,1,''); 

$pdf->Cell(20,7, "NAMA" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, $d['karyawan_nama'] ,0,1,''); 

$pdf->Cell(20,4, "" ,0,1,'');


$jadwal = mysqli_query($koneksi,"SELECT * FROM jadwal where jadwal_tahun='$tahun' and jadwal_bulan='$bulan' and jadwal_karyawan='$id_karyawan'");
$cek = mysqli_num_rows($jadwal);


if($cek > 0){


  $pdf->Cell(10,6,'Day' ,1,0,'C');
  $pdf->Cell(40,6,'Shift' ,1,0,'C');
  $pdf->Cell(20,6,'Divisi' ,1,0,'C');
  $pdf->Cell(120,6,'Nama Penugasan' ,1,1,'C');

  while($j = mysqli_fetch_array($jadwal)){

    if($j['jadwal_shift'] == 0){
      $xxx = "-";
    }else{
      $x = $j['jadwal_shift'];

      if($x == 1){
        $xxx = "Shift 1 (07.00 - 15.00)";

      }else if($x == 2){
        $xxx = "Shift 2 (15.00 - 11.00)";

      }else if($x == 3){
        $xxx = "Shift 3 (11.00 - 08.00)";

      }else if($x == 4){
        $xxx = "Shift 4 (11.00 - 18.00)";

      }

    }

    $pdf->Cell(10,6,$j['jadwal_day'] ,1,0,'C');
    $pdf->Cell(40,6, $xxx ,1,0,'C');
    $pdf->Cell(20,6, $j['jadwal_divisi'] ,1,0,'C');
    $pdf->Cell(120,6, $j['jadwal_penugasan'] ,1,1,'C');

  }

}else{

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,6, 'Belum ada jadwal' ,0,1,'C');
}





$pdf->Output();
?>