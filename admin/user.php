<?php include 'header.php'; ?>

<div class="container">

 <div class="my-4 border-bottom">
    <h2 class="fw-semibold fs-3">Admin</h2>
  </div>

  <section class="content">
    <div class="row justify-content-center">
      <section class="col-lg-8">
        <div class="card card-info">

          <div class="card-header d-flex justify-content-between">
            <span class="card-title fw-semibold">Admin</span>
            <a href="user_tambah.php" class="btn btn-primary btn-sm pull-right"><i class="bi bi-plus"></i> &nbsp Tambah Admin Baru</a>              
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th width="15%">FOTO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM user");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['user_nama']; ?></td>
                      <td><?php echo $d['user_username']; ?></td>
                      <td>
                        <center>
                          <?php if($d['user_foto'] == ""){ ?>
                            <img src="../gambar/sistem/user.png" style="width: 30px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/user/<?php echo $d['user_foto'] ?>" style="width: 30px;height: auto">
                          <?php } ?>
                        </center>
                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="user_edit.php?id=<?php echo $d['user_id'] ?>"><i class="bi bi-gear"></i></a>
                        <?php if($d['user_id'] != 1){ ?>
                          <a onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm" href="user_hapus.php?id=<?php echo $d['user_id'] ?>"><i class="bi bi-trash"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>