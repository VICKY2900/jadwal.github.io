<?php include 'header.php'; ?>

<div class="container">

  <div class="my-4 border-bottom">
    <h2 class="fw-semibold fs-3">Admin</h2>
  </div>

  <section class="content">
    <div class="row justify-content-center">
      <section class="col-lg-4">       
        <div class="card card-info">

          <div class="card-header d-flex justify-content-between">
            <span class="card-title fw-semibold">Tambah Admin</span>
            <a href="user.php" class="btn btn-primary btn-sm pull-right"><i class="bi bi-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="card-body">
            <form action="user_act.php" method="post" enctype="multipart/form-data">
              <div class="form-group mb-2">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>
              <div class="form-group mb-2">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required="required" placeholder="Masukkan Username ..">
              </div>
              <div class="form-group mb-2">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required="required" min="5" placeholder="Masukkan Password ..">
              </div>
              <div class="form-group mb-2">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control">
              </div>
              <div class="form-group mb-2">
                <input type="submit" class="btn btn-primary" value="Simpan">
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>