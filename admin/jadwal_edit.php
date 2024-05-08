<?php include 'header.php'; ?>

<div class="container">

  <div class="my-4 border-bottom  d-flex justify-content-between">
    <h2 class="fw-semibold fs-3">Jadwal Karyawan</h2>
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
    $tahun = $_GET['tahun'];
    $bulan = $_GET['bulan'];
    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    ?>
    <form method="POST" action="jadwal_update.php">
      <div class="card card-info">

        <div class="card-header d-flex justify-content-between">
          <span class="card-title  fw-semibold">Edit Jadwal</span>
          <div>
            <a href="jadwal.php?tahun=<?php echo $tahun ?>&bulan=<?php echo $bulan ?>" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-arrow-left"></i> &nbsp Kembali</a>           
            <input type="submit" class="btn btn-primary btn-sm px-5" value="SIMPAN">
          </div>
        </div>

        <div class="card-body">
          
          <input type="hidden" name="tahun" value="<?php echo $tahun ?>">
          <input type="hidden" name="bulan" value="<?php echo $bulan ?>">
          <div class="table-responsive">
            <table class="table table-bordered" id="table-datatable-jadwa">
              <thead>
                <tr>
                  <th class="text-center" rowspan="2" width="1%">NO</th>
                  <th class="text-center" rowspan="2">NAMA</th>
                  <th class="text-center" colspan="<?php echo $jumlah_hari ?>">Day</th>
                </tr>
                <tr>
                  <?php 
                  for ($i=1; $i <= $jumlah_hari; $i++) { 
                    ?>
                    <td class="text-center" width="200px" style="width:300px !important"><?php echo $i ?></td>
                    <?php
                  }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no=1;
                $data = mysqli_query($koneksi,"SELECT * FROM karyawan");
                while($d = mysqli_fetch_array($data)){
                  $id_karyawan = $d['karyawan_id'];
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td class="text-truncate">
                      <?php echo $d['karyawan_nama']; ?>
                      <input type="hidden" name="karyawan[]" value="<?php echo $id_karyawan ?>">
                    </td>

                    <?php 
                    $jadwal = mysqli_query($koneksi,"SELECT * FROM jadwal where jadwal_tahun='$tahun' and jadwal_bulan='$bulan' and jadwal_karyawan='$id_karyawan'");
                    $cek = mysqli_num_rows($jadwal);
                    if($cek > 0){
                      while($j = mysqli_fetch_array($jadwal)){
                        ?>

                        <td class="text-truncate bg-primary text-white">
                          <div class="form-group mb-2">
                            <label class="form-label fw-semibold text-start">Divisi</label>
                            <select name="divisi[<?php echo $id_karyawan ?>][]" class="form-control" required="required" style="min-width: 170px;">
                              <option value="-">-</option>
                              <option <?php if($j['jadwal_divisi'] == "IT"){echo "selected='selected'"; } ?> value="IT">IT</option>
                              <option <?php if($j['jadwal_divisi'] == "MT"){echo "selected='selected'"; } ?> value="MT">MT</option>
                            </select>
                          </div>  
                          <div class="form-group mb-2">
                            <label class="form-label fw-semibold text-start">Nama Penugasan</label>
                            <input type="text" class="form-control" name="penugasan[<?php echo $id_karyawan ?>][]" value="<?php echo $j['jadwal_penugasan'] ?>">
                          </div>                       
                          <div class="form-group mb-2">
                            <label class="form-label fw-semibold text-start">Shift</label>
                            <select name="shift[<?php echo $id_karyawan ?>][]" class="form-control" required="required" style="min-width: 170px;">
                              <option  <?php if($j['jadwal_shift'] == "0"){echo "selected='selected'"; } ?> value="0">-</option>
                              <option  <?php if($j['jadwal_shift'] == "1"){echo "selected='selected'"; } ?> value="1">shift 1 : 07.00 - 15.00</option>
                              <option  <?php if($j['jadwal_shift'] == "2"){echo "selected='selected'"; } ?> value="2">Shift 2 : 15.00 - 11.00</option>
                              <option  <?php if($j['jadwal_shift'] == "3"){echo "selected='selected'"; } ?> value="3">Shift 3 : 11.00 - 08.00</option>
                              <option  <?php if($j['jadwal_shift'] == "4"){echo "selected='selected'"; } ?> value="4">Shift 4 : 11.00 - 18.00</option>
                            </select>
                          </div>
                        </td>

                        <?php                      
                      }
                    }else{
                      ?>
                      <?php 
                      for ($i=1; $i <= $jumlah_hari; $i++) { 
                        ?>

                        <td class="text-truncate bg-primary text-white">
                          <div class="form-group mb-2">
                            <label class="form-label fw-semibold text-start">Divisi</label>
                            <select name="divisi[<?php echo $id_karyawan ?>][]" class="form-control" required="required" style="min-width: 170px;">
                              <option value="-">-</option>
                              <option value="IT">IT</option>
                              <option value="MT">MT</option>
                            </select>
                          </div>   
                          <div class="form-group mb-2">
                            <label class="form-label fw-semibold text-start">Nama Penugasan</label>
                            <input type="text" class="form-control" name="penugasan[<?php echo $id_karyawan ?>][]" value="">
                          </div>                     
                          <div class="form-group mb-2">
                            <label class="form-label fw-semibold text-start">Shift</label>
                            <select name="shift[<?php echo $id_karyawan ?>][]" class="form-control" required="required" style="min-width: 170px;">
                              <option value="0">-</option>
                              <option value="1">shift 1 : 07.00 - 15.00</option>
                              <option value="2">Shift 2 : 15.00 - 11.00</option>
                              <option value="3">Shift 3 : 11.00 - 08.00</option>
                              <option value="4">Shift 4 : 11.00 - 18.00</option>
                            </select>
                          </div>
                        </td>

                        <?php
                      }
                    }
                    ?>  
                  </tr>
                  <?php 
                }
                ?>
              </tbody>
            </table>
          </div>
          
        </div>

      </div>

    </form>
    <?php 
  }
  ?>

</div>
<?php include 'footer.php'; ?>