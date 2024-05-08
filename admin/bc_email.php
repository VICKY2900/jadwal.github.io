<?php 
date_default_timezone_set('Asia/Jakarta');
session_start();
if($_SESSION['status'] != "administrator_logedin"){
  header("location:../index.php?alert=belum_login");
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../koneksi.php';
$tahun = $_GET['tahun'];
$bulan = $_GET['bulan'];



require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$karyawan = mysqli_query($koneksi,"SELECT * FROM karyawan");
while($k = mysqli_fetch_array($karyawan)){


  $email = htmlspecialchars($k['karyawan_email']);
  $id_karyawan = htmlspecialchars($k['karyawan_id']);

  $isi_pesan = 'Halo <b>'. $k['karyawan_nama']."</b>, <br>";
  $isi_pesan .= 'Berikut adalah link jadwal anda pada <b>Bulan '. $bulan .' Tahun '.$tahun."</b><br>";
  $isi_pesan .= "<a href='http://localhost/project_jadwal2/jadwal.php?tahun=".$tahun."&bulan=".$bulan."&karyawan=".$id_karyawan."'>DOWNLOAD JADWAL</a>";
  $isi_pesan .= "<br>";
  $isi_pesan .= "<br>";
  $isi_pesan .= "Terima kasih,<br>";
  $isi_pesan .= "Sistem Jadwal Shift Karyawan TVRI";

  $pesan = $isi_pesan;

  $mail = new PHPMailer(true);

  try {                       
    $mail->SMTPDebug = 2;  
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    // email aktif yang sebelumnya di setting
    $mail->Username   = 'dikialfarabihadi@gmail.com';
    // password yang sebelumnya di simpan
    $mail->Password   = 'scvzqvtasvujjiid';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;  

    $mail->setFrom('mail@gmail.com', "Jadwal Shift Karyawan TVRI");
    $mail->addAddress($email); 
    $mail->Subject = "Jadwal Shift Karyawan TVRI";    
    $mail->Body = $pesan;
    $mail->isHTML(true);
    $mail->send();

  }catch (Exception $e) {
   header("location:bc.php?alert=gagal");  
 }

}

header("location:bc.php?alert=sukses");  


?>