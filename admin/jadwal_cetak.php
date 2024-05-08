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


// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan



$pdf->SetFont('Arial','B',14);
$pdf->Cell(275,7, "JADWAL DINAS PETUGAS IT, LAYANAN MEDIA BARU DAN PEMELIHARAAN PERALATAN" ,0,1,'C'); 


$pdf->Cell(20,4, "" ,0,1,''); 

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,7, "TAHUN" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, $tahun ,0,1,''); 

$pdf->Cell(20,7, "BULAN" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, $arr_bulan[$bulan] ,0,1,''); 

$pdf->Cell(20,4, "" ,0,1,'');

$pdf->Cell(45,6,'Teknic Support' ,'LTR',0,'C');
$pdf->Cell(230,6,'TANGGAL' ,1,1,'C');

$pdf->Cell(45,6,'','LBR',0,'C');

$ukuran = 230/$jumlah_hari;
for ($i=1; $i <= $jumlah_hari; $i++) { 
  $pdf->Cell($ukuran,6,$i ,1,0,'C');
}
$pdf->Cell(1,6,'' ,0,1,'C');


$no=1;
$data = mysqli_query($koneksi,"SELECT * FROM karyawan");
while($d = mysqli_fetch_array($data)){
  $id_karyawan = $d['karyawan_id'];

  $pdf->Cell(45,6,$d['karyawan_nama'],'L',0,'');


  $jadwal = mysqli_query($koneksi,"SELECT * FROM jadwal where jadwal_tahun='$tahun' and jadwal_bulan='$bulan' and jadwal_karyawan='$id_karyawan'");
  $cek = mysqli_num_rows($jadwal);

  if($cek > 0){
    while($j = mysqli_fetch_array($jadwal)){
      $pdf->Cell($ukuran,6, $j['jadwal_divisi'] ,'LR',0,'C');
    }


  }else{
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(230,6, 'Jadwal belum diinput' ,'LTR',0,'C');
  }

  $pdf->Cell(1,6,'' ,0,1,'C');

// ----------------------------------


  $pdf->Cell(45,6,"",'LB',0,'');


  $jadwal = mysqli_query($koneksi,"SELECT * FROM jadwal where jadwal_tahun='$tahun' and jadwal_bulan='$bulan' and jadwal_karyawan='$id_karyawan'");
  $cek = mysqli_num_rows($jadwal);

  if($cek > 0){
    while($j = mysqli_fetch_array($jadwal)){
      if($j['jadwal_shift'] == 0){
       $pdf->Cell($ukuran,6, '-' ,'LBR',0,'C');
     }else{
       $pdf->Cell($ukuran,6, $j['jadwal_shift'] ,'LBR',0,'C');
     }
   }


 }else{
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(230,6, '' ,'LBR',0,'C');
}

$pdf->Cell(1,6,'' ,0,1,'C');

}



$pdf->Cell(1,10,'' ,0,1,'C');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,7, "Keterangan :" ,0,1,''); 

$pdf->Cell(20,7, "Shift 1" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, "07.00 - 15.00" ,0,1,''); 

$pdf->Cell(20,7, "Shift 2" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, "15.00 - 11.00" ,0,1,''); 

$pdf->Cell(20,7, "Shift 3" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, "11.00 - 08.00" ,0,1,''); 

$pdf->Cell(20,7, "Shift 4" ,0,0,''); 
$pdf->Cell(1,7, ":" ,0,0,'C'); 
$pdf->Cell(50,7, "11.00 - 18.00" ,0,1,''); 

$pdf->ln();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(275,7, "INFORMASI NAMA PENUGASAN" ,0,1,''); 
$pdf->ln(2);



$pdf->Cell(30,6,'Tanggal' ,1,0,'C');
$pdf->Cell(75,6,'Nama Karyawan' ,1,0,'C');
$pdf->Cell(20,6,'Shift' ,1,0,'C');
$pdf->Cell(20,6,'Divisi' ,1,0,'C');
$pdf->Cell(130,6,'Nama Penugasan' ,1,1,'C');


for ($i=1; $i <= $jumlah_hari; $i++) { 
  $no=1;
  $data = mysqli_query($koneksi,"SELECT * FROM karyawan");
  while($d = mysqli_fetch_array($data)){
    $id_karyawan = $d['karyawan_id'];

    $day = $i;
    $jadwal = mysqli_query($koneksi,"SELECT * FROM jadwal where jadwal_tahun='$tahun' and jadwal_bulan='$bulan' and jadwal_day='$day' and jadwal_karyawan='$id_karyawan'");
    while($j = mysqli_fetch_array($jadwal)){

      if($j['jadwal_shift'] == 0){
        $x = "-";
      }else{
        $x = $j['jadwal_shift'];
      }

      $pdf->Cell(30,6,$j['jadwal_day'] . " / " . $bulan . " / ". $tahun ,1,0,'C');
      $pdf->Cell(75,6, $d['karyawan_nama'] ,1,0,'C');
      $pdf->Cell(20,6, $x ,1,0,'C');
      $pdf->Cell(20,6, $j['jadwal_divisi'] ,1,0,'C');
      $pdf->Cell(130,6, $j['jadwal_penugasan'] ,1,1,'C');


    }
  }
}



$pdf->Output();
?>