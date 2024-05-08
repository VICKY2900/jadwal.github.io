<?php include 'header.php'; ?>

<div class="container">

  <div class="my-4 border-bottom  d-flex justify-content-between">
    <h2 class="fw-semibold fs-3">Broadcast Jadwal</h2>
  </div>

  <form action="" method="get">

    <div class="alert alert-success text-center fw-semibold">
      Kirim jadwal ke email karyawan
    </div>
    <br>

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
        <input type="submit" class="btn btn-primary" value="Pilih Jadwal">
      </div>
    </div>

  </form>

  <br>

  <?php 
  if(isset($_GET['alert'])){
    if($_GET['alert'] == "sukses"){
      echo "<div class='alert alert-success text-center fw-semibold'>Jadwal karyawan telah dibagikan ke email masing-masing!</div>";
    }else   if($_GET['alert'] == "gagal"){
      echo "<div class='alert alert-danger text-center fw-semibold'>Pengiriman email gagal!</div>";
    }
  }
  ?>

  <?php 
  if(isset($_GET['tahun'])){
    $tahun = $_GET['tahun'];
    $bulan = $_GET['bulan'];
    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    ?>
    <div class="card card-info">

      <div class="card-header d-flex justify-content-between">
        <span class="card-title  fw-semibold">Data Jadwal</span>
        <div>   
            <a target="_blank" onclick="return confirm('Apakah anda yakin ingin mengirimkan jadwal?')" href="bc_email.php?bulan=<?php echo $bulan ?>&tahun=<?php echo $tahun ?>" class="btn btn-success btn-sm fw-semibold"><i class="bi bi-envelope"></i> &nbsp KIRIM KE EMAIL SEMUA KARYAWAN</a> 
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table-datatable-jadwal2">
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
                  <td class="text-center"><?php echo $i ?></td>
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
                  <td class="text-truncate"><?php echo $d['karyawan_nama']; ?></td>

                  <?php 
                  $jadwal = mysqli_query($koneksi,"SELECT * FROM jadwal where jadwal_tahun='$tahun' and jadwal_bulan='$bulan' and jadwal_karyawan='$id_karyawan'");
                  $cek = mysqli_num_rows($jadwal);
                  if($cek > 0){
                    while($j = mysqli_fetch_array($jadwal)){
                      if($j['jadwal_shift'] == 0){
                        ?>
                        <td class="bg-danger table-danger text-white text-center small" style="font-size: 10pt;"></td>
                        <?php 
                      }else{
                        ?>
                        <td class="text-truncate text-center bg-success text-white">
                          <small class="small" style="font-size: 10pt;">
                            <?php echo $j['jadwal_divisi'] ?>
                            <br>
                            <?php echo $j['jadwal_penugasan'] ?>
                            <br>
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
                          </small>                          
                        </td>
                        <?php
                      }

                    }
                  }else{
                    ?>
                    <td colspan="<?php echo $jumlah_hari ?>" class="text-center bg-warning">Jadwal belum diinput</td>
                    <?php 
                    for ($i=0; $i < $jumlah_hari-1; $i++) { 
                      ?>
                      <td style="display: none;">Jadwal belum diinput</td>
                      <?php
                    }
                    ?>
                    <?php
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
    <?php 
  }
  ?>

</div>
<?php include 'footer.php'; ?>