<?php 
include 'header.php';
include '../koneksi.php';
?>

<div class="container">

  <div class="my-4 border-bottom">
    <h2 class="fw-semibold fs-3">Admin</h2>
  </div>

  <section class="content">
    <div class="row justify-content-center">
      <section class="col-lg-4">       
        <div class="card card-info">

          <div class="card-header d-flex justify-content-between">
            <span class="card-title fw-semibold">Edit Admin</span>
            <a href="user.php" class="btn btn-primary btn-sm pull-right"><i class="bi bi-reply"></i> &nbsp; Kembali</a> 
          </div>
          <div class="card-body">
            <form action="user_update.php" method="post" enctype="multipart/form-data">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "select * from user where user_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>

                <div class="form-group mb-2">
                  <label class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?php echo $d['user_nama'] ?>" required="required">
                  <input type="hidden" class="form-control" name="id" value="<?php echo $d['user_id'] ?>" required="required">
                </div>

                <div class="form-group mb-2">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" value="<?php echo $d['user_username'] ?>" required="required">
                </div>

                <div class="form-group mb-2">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" min="5" placeholder="Kosong Jika tidak ingin di ganti">
                  <p>Kosong Jika tidak ingin di ganti</p>
                </div>

                <div class="form-group mb-2">
                  <label class="form-label">Foto</label>
                  <input type="file" name="foto" class="form-control">
                  <p>Kosong Jika tidak ingin di ganti</p>
                </div>

                <div class="form-group mb-2">
                  <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                </div>
                <?php
              }

              ?>
              
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>