	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>



	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/jquery.datatables.min.js"></script>
	<script src="../assets/js/datatables-bootstrap5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
	<script src="../assets/js/chart.js"></script>
	
</body>

<script type="text/javascript">

	$(document).ready(function(){

		function getDaysInMonth(year, month) {
			return new Date(year, month, 0).getDate();
		}

		new DataTable('#table-datatable-jadwal', {
			fixedColumns: {
				left: 2
			},
			paging: false,
			scrollCollapse: true,
			scrollX: true,
			scrollY: 300,
			"ordering": false,
		});

		$("body").on("change", ".pilih-bulan", function() {
			var bulan = $(this).val();
			var tahun = $(".pilih-tahun").val();
			var cek = tahun.length;
			if(tahun.length > 0){
				var data = "bulan=" + bulan + "&tahun=" + tahun;
				$.ajax({
					type: "POST",
					url: "jadwal_tambah_ajax.php",
					data: data,
					success: function(html) {

						$(".tampil_hari").html(html);

					}

				});
			}else{
				alert('Silahkan isi tahun terlebih dahulu');
			}
			
		});

		// ubah jumlah
		// $("body").on("change", ".pilih-bulan", function() {
		// 	var bulan = $(this).val();
		
		// 	var data = "bulan=" + bulan;

		// 	$.ajax({
		// 		type: "POST",
		// 		url: "jadwal_tambah_ajax.php",
		// 		data: data,
		// 		success: function(html) {

		// 			$(ini).closest('tr').find('.tersedia').text(html);

		// 			var x = '<td><input type="number" name="update[]" class="update form-control" value="0" min="1"></td>';
		// 			$(ini).closest('tr').find('.update').html(x);
		// 			$(ini).closest('tr').find('.update').val(0);

		// 		}

		// 	});
		// });


		$('#table-datatable').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : false,
			'info'        : true,
			'autoWidth'   : true,
			"pageLength": 10
		});

		$('#table-datatable-produk').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : false,
			'info'        : true,
			'autoWidth'   : true,
			"pageLength": 10
		});

		function formatNumber(num) {
			return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
		}

		$("body").on("click","#tambah_item", function(){
			var x = '<tr>';
			x += '<td><input type="text" class="form-control ketik_item" name="item[]" placeholder="Masukkan nama item .."></td>';
			x += '<td><input type="number" min="1" class="form-control ketik_qty" name="qty[]" value="1"></td>';
			x += '<td><input type="text" class="form-control ketik_satuan" name="satuan[]"></td>';
			x += '<td><input type="number" min="0" class="form-control ketik_harga" name="harga[]" value="0"></td>';
			x += '<td><input type="number" min="0" class="form-control ketik_diskon" name="diskon[]" value="0"></td>';
			x += '<td class="text-center"><input type="hidden" class="form-control ketik_total" name="total[]" value="0"><span class="text_total" id="0">Rp.0,-</span></td>';
			x += '<td>';
			x += '<button type="button" href="" class="btn btn-sm btn-danger hapus_item"><i class="bi bi-x"></i></button>';
			x += '</td>';
			x += '</tr>';

			$("#table-pembelian tbody").append(x);
		});

		// $("body").on("click",".hapus_item", function(){
		// // $(this).remove();
		// 	$(this).closest("tr").remove();
		// // $("#table-pembelian tbody").prepend(x);

		// 	var item = $(this).closest("tr").find(".ketik_item").val();
		// 	var qty = $(this).closest("tr").find(".ketik_qty").val();
		// 	var harga = $(this).closest("tr").find(".ketik_harga").val();
		// 	var diskon = $(this).closest("tr").find(".ketik_diskon").val();

		// 	var total = harga * qty - diskon;

		// 	$(this).closest("tr").find(".ketik_total").val(total);
		// 	$(this).closest("tr").find(".text_total").text("Rp."+formatNumber(total)+",-");

		// 	var x = 0;
		// 	$(".ketik_total").each(function() {
		// 		x += eval(this.value);
		// 	});

		// 	$(".total_sub_form").val(x);
		// 	$(".total_sub_text").text("Rp."+formatNumber(x)+",-");

		// 	var total_diskon = $(".total_diskon").val();
		// 	var total_pajak = $(".total_pajak").val();

		// 	var tot = x - total_diskon;
		// 	var pajak = tot * total_pajak / 100;
		// 	var tot2 = tot + pajak;
		// 	$(".total_form").val(tot2);
		// 	$(".total_text").text("Rp."+formatNumber(tot2)+",-");
		// });

		// $("body").on("change keyup keydown",".ketik_item, .ketik_qty, .ketik_harga, .ketik_diskon, .total_diskon, .total_pajak", function(){
		// // $(this).remove();
		// 	var item = $(this).closest("tr").find(".ketik_item").val();
		// 	var qty = $(this).closest("tr").find(".ketik_qty").val();
		// 	var harga = $(this).closest("tr").find(".ketik_harga").val();
		// 	var diskon = $(this).closest("tr").find(".ketik_diskon").val();

		// 	var total = harga * qty - diskon;

		// 	$(this).closest("tr").find(".ketik_total").val(total);
		// 	$(this).closest("tr").find(".text_total").text("Rp."+formatNumber(total)+",-");

		// 	var x = 0;
		// 	$(".ketik_total").each(function() {
		// 		x += eval(this.value);
		// 	});

		// 	$(".total_sub_form").val(x);
		// 	$(".total_sub_text").text("Rp."+formatNumber(x)+",-");

		// 	var total_diskon = $(".total_diskon").val();
		// 	var total_pajak = $(".total_pajak").val();

		// 	var tot = x - total_diskon;
		// 	var pajak = tot * total_pajak / 100;
		// 	var tot2 = tot + pajak;
		// 	$(".total_form").val(tot2);
		// 	$(".total_text").text("Rp."+formatNumber(tot2)+",-");
		// });

		// $("body").on("click",".btn-pilih-produk", function(){
		// // $(this).remove();
		// 	var item = $(this).closest("td").find(".pilih_item").val();
		// 	var qty = 1;
		// 	var harga = $(this).closest("td").find(".pilih_harga").val();
		// 	var satuan = $(this).closest("td").find(".pilih_satuan").val();
		// 	var diskon = 0;

		// 	var total = harga * qty - diskon;

		// // $(this).closest("tr").find(".ketik_total").val(total);
		// // $(this).closest("tr").find(".text_total").text("Rp."+formatNumber(total)+",-");

		// 	var x = '<tr>';
		// 	x += '<td><input type="text" class="form-control ketik_item" name="item[]" placeholder="Masukkan nama item .." value="'+item+'"></td>';
		// 	x += '<td><input type="number" min="1" class="form-control ketik_qty" name="qty[]" value="'+qty+'"></td>';
		// 	x += '<td><input type="text" class="form-control ketik_satuan" name="satuan[]" value="'+satuan+'"></td>';
		// 	x += '<td><input type="number" min="0" class="form-control ketik_harga" name="harga[]" value="'+harga+'"></td>';
		// 	x += '<td><input type="number" min="0" class="form-control ketik_diskon" name="diskon[]" value="'+diskon+'"></td>';
		// 	x += '<td class="text-center"><input type="hidden" class="form-control ketik_total" name="total[]" value="'+total+'"><span class="text_total" id="0">'+"Rp."+formatNumber(total)+",-"+'</span></td>';
		// 	x += '<td>';
		// 	x += '<button type="button" href="" class="btn btn-sm btn-danger hapus_item"><i class="bi bi-x"></i></button>';
		// 	x += '</td>';
		// 	x += '</tr>';

		// 	$("#table-pembelian tbody").append(x);




		// 	var x = 0;
		// 	$(".ketik_total").each(function() {
		// 		x += eval(this.value);
		// 	});

		// 	$(".total_sub_form").val(x);
		// 	$(".total_sub_text").text("Rp."+formatNumber(x)+",-");

		// 	var total_diskon = $(".total_diskon").val();
		// 	var total_pajak = $(".total_pajak").val();

		// 	var tot = x - total_diskon;
		// 	var pajak = tot * total_pajak / 100;
		// 	var tot2 = tot + pajak;
		// 	$(".total_form").val(tot2);
		// 	$(".total_text").text("Rp."+formatNumber(tot2)+",-");
		// });

		// const ctx = document.getElementById('myChart');
		// new Chart(ctx, {
		// 	type: 'bar',
		// 	data: {
		// 		labels: [
		// 			'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		// 			],
		// 		datasets: [{
		// 			label: 'Lunas',
		// 			data: [
		// 				<?php
		// 				for($bulan=1;$bulan<=12;$bulan++){
		// 					$thn_ini = date('Y');
		// 					$inv = mysqli_query($koneksi,"SELECT * from invoice WHERE month(invoice_tanggal)='$bulan' and year(invoice_tanggal)='$thn_ini' and invoice_status='1'");
		// 					if(mysqli_num_rows($inv) > 0){
		// 						echo mysqli_num_rows($inv).',';
		// 					}else{
		// 						echo '0,';
		// 					}
		// 				}
		// 				?>
		// 				],
		// 			borderWidth: 1
		// 		},
		// 		{
		// 			label: 'Belum Lunas',
		// 			data: [
		// 				<?php
		// 				for($bulan=1;$bulan<=12;$bulan++){
		// 					$thn_ini = date('Y');
		// 					$inv = mysqli_query($koneksi,"SELECT * from invoice WHERE month(invoice_tanggal)='$bulan' and year(invoice_tanggal)='$thn_ini' and invoice_status='0'");
		// 					if(mysqli_num_rows($inv) > 0){
		// 						echo mysqli_num_rows($inv).',';
		// 					}else{
		// 						echo '0,';
		// 					}
		// 				}
		// 				?>
		// 				],
		// 			borderWidth: 1
		// 		}]
		// 	},
		// 	options: {
		// 		scales: {
		// 			y: {
		// 				beginAtZero: true
		// 			}
		// 		}
		// 	}
		// });


		// const ctx2 = document.getElementById('myChart2');
		// new Chart(ctx2, {
		// 	type: 'bar',
		// 	data: {
		// 		labels: [
		// 			<?php 
		// 			$tahun = mysqli_query($koneksi,"select distinct year(invoice_tanggal) as x from invoice order by x asc");
		// 			while($t = mysqli_fetch_array($tahun)){
		// 				echo $t['x'].',';
		// 			}
		// 			?>
		// 			],
		// 		datasets: [{
		// 			label: 'Lunas',
		// 			data: [
		// 				<?php
		// 				$tahun = mysqli_query($koneksi,"select distinct year(invoice_tanggal) as x from invoice order by x asc");
		// 				while($t = mysqli_fetch_array($tahun)){
		// 					$thn_ini =  $t['x'];
		// 					$inv = mysqli_query($koneksi,"SELECT * from invoice WHERE year(invoice_tanggal)='$thn_ini' and invoice_status='1'");
		// 					if(mysqli_num_rows($inv) > 0){
		// 						echo mysqli_num_rows($inv).',';
		// 					}else{
		// 						echo '0,';
		// 					}
		// 				}
		// 				?>
		// 				],
		// 			borderWidth: 1
		// 		},
		// 		{
		// 			label: 'Belum Lunas',
		// 			data: [
		// 				<?php
		// 				$tahun = mysqli_query($koneksi,"select distinct year(invoice_tanggal) as x from invoice order by x asc");
		// 				while($t = mysqli_fetch_array($tahun)){
		// 					$thn_ini =  $t['x'];
		// 					$inv = mysqli_query($koneksi,"SELECT * from invoice WHERE year(invoice_tanggal)='$thn_ini' and invoice_status='0'");
		// 					if(mysqli_num_rows($inv) > 0){
		// 						echo mysqli_num_rows($inv).',';
		// 					}else{
		// 						echo '0,';
		// 					}
		// 				}
		// 				?>
		// 				],
		// 			borderWidth: 1
		// 		}]
		// 	},
		// 	options: {
		// 		scales: {
		// 			y: {
		// 				beginAtZero: true
		// 			}
		// 		}
		// 	}
		// });
	});

</script>
</html>