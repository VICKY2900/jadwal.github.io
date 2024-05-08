<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrator - Sistem Informasi Jadwal Karyawan</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap-icon.css" rel="stylesheet">
  <link href="../assets/css/datatable-bootstrap5.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">
  <?php 
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "karyawan_logedin"){
    header("location:../index.php?alert=belum_login");
  }
  ?>

</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../gambar/sistem/logo.png" class="img-fluid" style="height: 30px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house"></i> <span>Dashboard</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="jadwal.php">
              <i class="bi bi-calendar2-week"></i> <span> Jadwal Saya</span>
            </a>
          </li>

        </ul>

         <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

          <li class="nav-item dropdown">
            <?php 
            $id_user = $_SESSION['id'];
            $profil = mysqli_query($koneksi,"select * from karyawan where karyawan_id='$id_user'");
            $profil = mysqli_fetch_assoc($profil);
            ?>
            <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person"></i> <span> Halo, <?php echo $profil['karyawan_nama']; ?></span>
            </a>
            <ul class="dropdown-menu shadow-sm dropdown-menu-end mt-2">
              <li><a class="dropdown-item" href="gantipassword.php"><i class="bi bi-lock"></i> Password</a></li>
              <li><a class="dropdown-item" href="logout.php"><i class="bi bi-power"></i> Log Out</a></li>
            </ul>
          </li>
          
        </ul>

      </div>
    </div>
  </nav>