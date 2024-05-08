<?php include 'header.php'; ?>

<div class="container">

  <div class="my-4 border-bottom">
    <h2 class="fw-semibold fs-3">Karyawan</h2>
  </div>

  <section class="content">
    <div class="row justify-content-center">
      <section class="col-lg-5">       
        <div class="card card-info">
          <div class="card-header d-flex justify-content-between">
            <span class="card-title fw-semibold">Tambah Karyawan</span>
            <a href="karyawan.php" class="btn btn-primary btn-sm"><i class="bi bi-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="card-body">
            <form action="karyawan_act.php" method="post" enctype="multipart/form-data">
              <div class="form-group mb-2">
                <label class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>
              <div class="form-group mb-2">
                <label class="form-label fw-semibold">No.HP</label>
                <input type="number" class="form-control" name="hp" required="required" placeholder="Masukkan No.HP ..">
              </div>
              <div class="form-group mb-2">
                <label class="form-label fw-semibold">Alamat</label>
                <input type="text" class="form-control" name="alamat" required="required" placeholder="Masukkan Alamat ..">
              </div>
              <div class="form-group mb-2">
                <label class="form-label fw-semibold">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" required="required" placeholder="Masukkan Jabatan ..">
              </div>
              <div class="form-group mb-2">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email" required="required" placeholder="Masukkan Email ..">
              </div>
               <div class="form-group mb-2">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" name="password" required="required" placeholder="Masukkan Password ..">
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