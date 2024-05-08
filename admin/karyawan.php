<?php include 'header.php'; ?>

<div class="container">

  <div class="my-4 border-bottom">
    <h2 class="fw-semibold fs-3">Karyawan</h2>
  </div>

  <div class="card card-info">

    <div class="card-header d-flex justify-content-between">
      <span class="card-title  fw-semibold">Data Karyawan</span>
      <a href="karyawan_tambah.php" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> &nbsp Tambah Karyawan</a>              
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="table-datatable">
          <thead>
            <tr>
              <th width="1%">NO</th>
              <th>NAMA</th>
              <th>JABATAN</th>
              <th>NO.HP</th>
              <th>EMAIL</th>
              <th>ALAMAT</th>
              <th width="10%">OPSI</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no=1;
            $data = mysqli_query($koneksi,"SELECT * FROM karyawan");
            while($d = mysqli_fetch_array($data)){
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['karyawan_nama']; ?></td>
                <td><?php echo $d['karyawan_jabatan']; ?></td>
                <td><?php echo $d['karyawan_hp']; ?></td>
                <td><?php echo $d['karyawan_email']; ?></td>
                <td><?php echo $d['karyawan_alamat']; ?></td>                      
                <td>                        
                  <a class="btn btn-warning btn-sm" href="karyawan_edit.php?id=<?php echo $d['karyawan_id'] ?>"><i class="bi bi-gear"></i></a>
                  <a onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm" href="karyawan_hapus.php?id=<?php echo $d['karyawan_id'] ?>"><i class="bi bi-trash"></i></a>
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

</div>
<?php include 'footer.php'; ?>