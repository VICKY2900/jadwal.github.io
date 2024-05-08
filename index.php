<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Jadwal Karyawan TVRI</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap-icon.css" rel="stylesheet">
  <link href="assets/css/datatable-bootstrap5.min.css" rel="stylesheet">
</head>
<body class="">
  <style type="text/css">
    body{
      background-image: url('gambar/sistem/bg.jpg');
      background-repeat: no-repeat;
      background-size: 100%;
    }
  </style>
 <div class="container">

  <div class="row justify-content-center">
    <div class="col-lg-3">

      <div class="card mt-5">
        <div class="card-body">

          <?php 

          if(isset($_GET['alert'])){
            if($_GET['alert'] == "gagal"){
              ?>
              <div class="alert alert-danger text-center fw-semibold">
                LOGIN GAGAL
              </div>
              <?php
            }else if($_GET['alert'] == "belum_login"){
              ?>
              <div class="alert alert-warning text-center fw-semibold">
                Silahkan login terlebih dulu
              </div>
              <?php
            }else if($_GET['alert'] == "logout"){
              ?>
              <div class="alert alert-success text-center fw-semibold">
                Anda telah logout
              </div>
              <?php
            }
          }
          ?>

          <center>
            <img src="gambar/sistem/logo.png" class="img-fluid" style="width:50%">
            <h4 class="fw-semibold my-3">Sistem Penjadwalan Karyawan</h4>
            <h6 class="fw-semibold my-3">Login</h6>
          </center>

          <form method="post" action="periksa_login.php">

            <div class="form-group mb-2">
              <label class="form-label mb-2 fw-semibold">Username / Email</label>
              <input type="text" required="required" name="username" class="form-control" placeholder="Username" autocomplete="off">
            </div>

            <div class="form-group mb-2">
              <label class="form-label mb-2 fw-semibold">Password</label>
              <input type="password" required="required" name="password" class="form-control" placeholder="************">
            </div>

            <div class="form-group mb-2">
              <label class="form-label mb-2 fw-semibold">Sebagai</label>
              <select class="form-control" required="required" name="sebagai">
                <option value="administrator">Administrator</option>
                <option value="karyawan">Karyawan</option>
              </select>
            </div>

            <div class="d-grid gap-2 my-3">
              <button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-lock"></i> LOGIN</button>
            </div>

          </form>
          
        </div>
      </div>
    </div>
  </div>

</div>



<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.datatables.min.js"></script>
<script src="assets/js/datatables-bootstrap5.min.js"></script>
<script src="assets/js/chart.js"></script>

</body>

<script type="text/javascript">

</script>
</html>