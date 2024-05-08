<?php 
include 'header.php';
include '../koneksi.php';
?>

<div class="container">

  <div class="my-4 border-bottom">
    <h2 class="fw-semibold fs-3">Karyawan</h2>
  </div>

  <section class="content">
    <div class="row justify-content-center">
      <section class="col-lg-5">       
        <div class="card card-info">

          <div class="card-header justify-content-between d-flex">
            <span class="card-title fw-semibold">Edit Karyawan</span>
            <a href="karyawan.php" class="btn btn-primary btn-sm pull-right"><i class="bi bi-reply"></i> &nbsp; Kembali</a> 
          </div>
          <div class="card-body">
            <form action="karyawan_update.php" method="post" enctype="multipart/form-data">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "select * from karyawan where karyawan_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>

                <div class="form-group mb-2">
                  <label class="form-label fw-semibold">Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?php echo $d['karyawan_nama'] ?>" required="required">
                  <input type="hidden" class="form-control" name="id" value="<?php echo $d['karyawan_id'] ?>" required="required">
                </div>

                 <div class="form-group mb-2">
                  <label class="form-label fw-semibold">No.HP</label>
                  <input type="number" class="form-control" name="hp" value="<?php echo $d['karyawan_hp'] ?>" required="required">
                </div>

                <div class="form-group mb-2">
                  <label class="form-label fw-semibold">Alamat</label>
                  <input type="text" class="form-control" name="alamat" value="<?php echo $d['karyawan_alamat'] ?>" required="required">
                </div>

                <div class="form-group mb-2">
                  <label class="form-label fw-semibold">Jabatan</label>
                  <input type="text" class="form-control" name="jabatan" value="<?php echo $d['karyawan_jabatan'] ?>" required="required">
                </div>

                 <div class="form-group mb-2">
                  <label class="form-label fw-semibold">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $d['karyawan_email'] ?>" required="required">
                </div>

                <div class="form-group mb-2">
                  <label class="form-label fw-semibold">Password</label>
                  <input type="password" class="form-control" name="password">
                  <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>

                <div class="form-group mb-2">
                  <input type="submit" class="btn btn-primary" value="Simpan">
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