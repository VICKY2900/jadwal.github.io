<?php include 'header.php'; ?>

<div class="container">

  <div class="my-4 border-bottom  d-flex justify-content-between">
    <h2 class="fw-semibold fs-3">Jadwal Saya</h2>
  </div>


  <form action="" method="get">

    <div class="row justify-content-center">

      <div class="form-group mb-2 col-2">
        <label class="form-label fw-semibold">Tahun</label>
        <select name="tahun" class="form-control" required="required">
          <option value="">- Pilih -</option>
          <?php 
          date_default_timezone_set('Asia/Jakarta');
          $a = date('Y');
          $b = date('Y') + 5;
          for($x = $a; $x <= $b; $x++){
            ?>
            <option <?php if(isset($_GET['tahun'])){ if($_GET['tahun'] == $x){ echo "selected='selected'"; } } ?> value="<?php echo $x; ?>"><?php echo $x; ?></option>
            <?php 
          }
          ?>
        </select>
      </div>

      <div class="form-group mb-2 col-2">
        <label class="form-label fw-semibold">Bulan</label>
        <select name="bulan" class="form-control" required="required">
          <option value="">- Pilih -</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 1){ echo "selected='selected'"; } } ?> value="1">Januari</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 2){ echo "selected='selected'"; } } ?> value="2">Februari</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 3){ echo "selected='selected'"; } } ?> value="3">Maret</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 4){ echo "selected='selected'"; } } ?> value="4">April</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 5){ echo "selected='selected'"; } } ?> value="5">Mei</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 6){ echo "selected='selected'"; } } ?> value="6">Juni</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 7){ echo "selected='selected'"; } } ?> value="7">Juli</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 8){ echo "selected='selected'"; } } ?> value="8">Agustus</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 9){ echo "selected='selected'"; } } ?> value="9">September</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 10){ echo "selected='selected'"; } } ?> value="10">Oktober</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 11){ echo "selected='selected'"; } } ?> value="11">November</option>
          <option <?php if(isset($_GET['bulan'])){ if($_GET['bulan'] == 12){ echo "selected='selected'"; } } ?> value="12">Desember</option>
        </select>
      </div>

      <div class="form-group mb-2 col-2">
        <br>
        <input type="submit" class="btn btn-primary" value="Tampilkan">
      </div>
    </div>

  </form>

  <br>

  <?php 
  if(isset($_GET['alert'])){
    if($_GET['alert'] == "sukses"){
      echo "<div class='alert alert-success text-center fw-semibold'>Jadwal karyawan telah diinput!</div>";
    }else   if($_GET['alert'] == "update"){
      echo "<div class='alert alert-success text-center fw-semibold'>Jadwal karyawan telah diupdate!</div>";
    }else   if($_GET['alert'] == "hapus"){
      echo "<div class='alert alert-success text-center fw-semibold'>Jadwal karyawan telah dihapus!</div>";
    }
  }
  ?>

  <?php 
  if(isset($_GET['tahun'])){
    $karyawan = $_SESSION['id'];
    $tahun = $_GET['tahun'];
    $bulan = $_GET['bulan'];
    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

    $data = mysqli_query($koneksi,"SELECT * FROM karyawan where karyawan_id='$karyawan'");
    $d = mysqli_fetch_assoc($data);
    $id_karyawan = $d['karyawan_id'];

    $jadwal = mysqli_query($koneksi,"SELECT * FROM jadwal where jadwal_tahun='$tahun' and jadwal_bulan='$bulan' and jadwal_karyawan='$id_karyawan'");
    $cek = mysqli_num_rows($jadwal);
    if($cek > 0){
     ?>


     <div class="card card-info">

      <div class="card-header d-flex justify-content-between">
        <span class="card-title  fw-semibold">Data Jadwal</span>
        <a href="jadwal_cetak.php?tahun=<?php echo $tahun ?>&bulan=<?php echo $bulan ?>" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> &nbsp Cetak PDF</a> 
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="table-datatable-jadwa">
            <thead>
              <tr>
                <th class="text-center" width="20%">Day</th>
                <th class="text-center" width="30%">Shift</th>
                <th class="text-center">Divisi</th>
                <th class="text-center">Nama Penugasan</th>
              </tr>
            </thead>
            <tbody>


              <?php 
              while($j = mysqli_fetch_array($jadwal)){
                if($j['jadwal_shift'] == 0){
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $j['jadwal_day'] ?></td>
                    <td class="bg-danger table-danger text-white text-center"></td>
                    <td class="text-center"><?php echo $j['jadwal_divisi'] ?></td>
                    <td class="text-center"><?php echo $j['jadwal_penugasan'] ?></td>
                  </tr>
                  <?php 
                }else{
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $j['jadwal_day'] ?></td>
                    <td class="text-truncate text-center bg-success text-white">
                      <?php 
                      if($j['jadwal_shift']=="1"){ 
                        echo "07.00 - 15.00"; 
                      }elseif($j['jadwal_shift']=="2"){ 
                        echo "15.00 - 11.00"; 
                      }elseif($j['jadwal_shift']=="3"){ 
                        echo "11.00 - 08.00"; 
                      }elseif($j['jadwal_shift']=="4"){ 
                        echo "11.00 - 18.00"; 
                      }
                      ?>
                    </td>
                    <td class="text-center"><?php echo $j['jadwal_divisi'] ?></td>
                    <td class="text-center"><?php echo $j['jadwal_penugasan'] ?></td>
                  </tr>
                  <?php
                }
              }
              ?>


            </tbody>
          </table>
        </div>
      </div>

    </div>
    <?php
  }else{
    ?>

    <br>
    <br>
    <br>
    <h4 class="fw-bold text-center">Belum ada jadwal</h4>

    <?php
  }
}
?>     



</div>
<?php include 'footer.php'; ?>