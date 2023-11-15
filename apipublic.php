<div class="page-inner">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Pencarian</div>
				</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-4 col-lg-12">
								<div class="form-group">
									<label >Tahun</label>
									<input type="text" class="form-control" id="txttahun">
								</div>
								<div class="form-group">
									<label>Bulan</label>
										<select class="form-control" id="cbobulan" style="font-size: 20px;">
											<option value="1">Januari</option>
											<option value="2">Februari</option>
											<option value="3">Maret</option>
											<option value="4">April</option>
											<option value="5">Mei</option>
											<option value="6">Juni</option>
											<option value="7">Juli</option>
											<option value="8">Agustus</option>
											<option value="9">September</option>
											<option value="10">oktober</option>
											<option value="11">November</option>
											<option value="12">Desember</option>
										</select>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-primary" onclick="caridata()">Cari</button> 
									<button type="button" class="btn btn-danger" onclick="kosongdata()">Reset </button>
									<button type="button" class="btn btn-secondary" onclick="apigrafik()">Grafik By Tahun </button>
								</div>
							</div>
						</div>
					</div>
			</div>

			<div class="card">
				<div class="card-header">
					<div class="car-header-row">
						<div class="card-title">Grafik
							<div class="float-right pt-1">
								<button type="button" class="btn btn-primary" onclick="cetakgrafik()">Cetak Pdf</button>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body" id="blokgrafik1"></div>
			</div>
		</div>

		<div class="col-12 col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">API publik
						<div class="float-right pt-1">
							<button type="button" class="btn btn-success" onclick="cetakdataexcel2()"> Excel By SimpleXlsGen </button>
							<button type="button" class="btn btn-danger" onclick="cetakdatapdf2()"> PDF by Mpdf </button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltabel"> Preview Data</button>
						</div>
					</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="table-responsive">
							<table id="tbl-data" class="display table table-striped table-hover">
								<thead>
									<tr>
										<th style="width: 15%;">ID Order</th>
										<th style="width: 20%;">Tgl Order</th>
										<th style="width: 15%;">Status</th>
										<th style="width: 50%;">Comment</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="modal fade" role="dialog" id="modaltabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" style="font-size: 20px;">Data Hasil Percarian</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body" id="bloktabel">
							<h2 id="blokjudultabel" style="text-align: center;"></h2>
							<table class="efektabel">
								<thead>
									<tr style="background-color: #336E7B; color: white;">
										<th class="efektabel" style="padding: 5px; width: 15%;"> ID Order</th>
										<th class="efektabel" style="padding: 5px; width: 20%;"> Tgl Order</th>
										<th class="efektabel" style="padding: 5px; width: 15%;"> Status</th>
										<th class="efektabel" style="padding: 5px; width: 50%;"> Comment</th>
									</tr>
								</thead>
								<tbody id="blokdttabel"></tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" onclick="cetakdataexcel()"> Cetak Excel</button>
							<button type="button" class="btn btn-primary" onclick="cetakdatapdf()"> Cetak PDF</button>	
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" role="dialog" id="modalgrafik">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" style="font-size: 20px;">Grafik Tahunan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body" id="blokgrafik2"></div>
					</div>
				</div>
			</div>
	</div>
</div>

<script>
	$("#mnapipublic").addClass("active");
	let tblapipublic = $('#tbl-data').DataTable();

	function caridata() {
		let th= $(" #txttahun").val();
		let bln = $("#cbobulan").val();
			if(th == "" || bln == ""){
				swal({title: "Gagal", text: "Ada Isian yang Masih Kosong", icon: "error"});
				return;
	}
	$.getJSON(
		"https://rindhidwif04.000webhostapp.com/coba-api/api2.php?data=penjualan&tahun="+th +"&bulan="+ bln,
		function(result){
			tblapipublic.clear().draw();
			let tglf = [];
			let jumlahf = [];
			let tglterakhir = "";
			let jmlterakhir = 0;
			let tabelku = "";
			$.each(result, function(i, kolom) {
				let idorder = kolom.orderNumber;
				let tgl = kolom.orderDate;
				let status = kolom.status;
				let komen = kolom.comments;
				if(tgl == tglterakhir){
					jmlterakhir++;
				}else{
					tglf.push(tglterakhir);
					jumlahf.push(parseInt(jmlterakhir));
					tglterakhir = tgl;
					jmlterakhir = 1;
				}
				tabelku += "<tr><td class='efektabel' style='padding: 5px;'>" + idorder + "</td><td class='efektabel' style='padding: 5px;'>" + tgl + "</td><td class='efektabel' style='padding: 5px;'>" + status + "</td><td class='efektabel' style='padding: 5px;'>" + komen + "</td></tr>";
				tblapipublic.row.add([idorder, tgl, status, komen]).draw();
			})
			$("#blokjudultabel").html("Hasil Pencarian Data Tahun " + th + " Bulan " + bln);
			$("#blokdttabel").html(tabelku);
			tglf.push(tglterakhir);
			jumlahf.push(parseInt(jmlterakhir));
			tglf.shift();
			jumlahf.shift();
			grafikq(tglf, jumlahf);
		}
	)
	}
	function kosongdata(){
		$("#txttahun").val("");
		$("#cbobulan").val("1");
		tblapipublic.clear().draw();
	}
	function cetakgrafik(){
		let isi = $("#blokgrafik1").html();
		if (isi == "") {
			swal({title: "Info", text: "Grafik Masih Kosong", icon: "info"});
			return;
		}
		var opt = {
			margin: 1,
			filename: "grafik.pdf",
			image: {type: 'jpeg', quality: 0.98},
			html2canvas: {scale: 4},
			jsPDF: {unit: 'cm', format: 'A4', orientation: 'l'}
		};
		let element = document.getElementById("blokgrafik1");
		html2pdf().set(opt).from(element).save();
	}
	function cetakdatapdf(){
		let isi = $("#blokdttabel").html();
		if (isi == "") {
			swal({title: "Info", text: "Data Hasil Pencarian Masih Kosong", icon: "info"});
			return;
		}
		let element = document.getElementById("bloktabel");
		html2pdf().set({html2canvas: {scale:4}}).from(element).save("data.pdf");
	}
	function cetakdatapdf2(){
		let th = $("#txttahun").val();
		let bln = $("#cbobulan").val();
		if(th == "" || bln == ""){
			swal({title: "Gagal", text: "Tahun atau Bulan Masih Kosong", icon: "error"});
			return;
		}
		let parameter = btoa(th + "-" + bln);
		window.open("reportpdf.php?parameter=" + parameter, "_blank");
	}
	function grafikq(tglf, jumlahf) {
		Highcharts.chart('blokgrafik1',{
			chart: {type: 'column'},
			title: {text: "Grafik Penjualan Bulan Ini"},
			subtitle: {text: ''},
			xAxis: {categories: tglf, crosshair: true},
			yAxis: {min: 0, title: {text: ''}},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y:0f} Transaksi</b></td></tr>',
				footerFormat: '</table>',
				shared: true, useHTML: true
			},
			plotOptions: {
				column: {pointPadding: 0.2, borderWidth: 0, dataLabels: {enabled: true}}
			},
			series: [{name: "Tanggal", data: jumlahf}]
		});
	}
	function cetakdataexcel(){
		let isi = $("#blokdttabel").html();
		if (isi == ""){
			swal({title: "Info", text: "Data Hasil Pencarian Masih Kosong", icon: "info"});
			return;
		}
		let data = document.getElementById('bloktabel');
		let file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
		XLSX.write(file, { bookType: "xlsx", bookSST: true, type: 'base64' });
		XLSX.writeFile(file, "data.xlsx");
	}
	function cetakdataexcel2(){
		let th = $("#txttahun").val();
		let bln = $("#cbobulan").val();
		if(th == "" || bln == ""){
			swal({title: "Gagal", text: "Tahun atau Bulan Masih Kosong", icon: "error"});
			return;
		}
		let parameter = btoa(th + "-" + bln);
		window.open("reportexcel.php?parameter=" + parameter, "_blank");	
	}
	function apigrafik(){
		let th = $("#txttahun").val();
		if(th == ""){
			swal({title: "Gagal", text: "Isian Tahun Masih Kosong", icon: "error"});
			return;
		}
		$.getJSON("https://rindhidwif04.000webhostapp.com/coba-api/api2.php?data=grafik_tahun&tahun=" +th, function(result){
			if(result.length != 0){
				let masaf = [];
				let jumlahf = [];
				$.each(result, function(i, kolom){
					let bln = kolom.bulan;
					let thn = kolom.tahun;
					let jml = kolom.jumlah;
					let masa = bln + "-" + thn;
					masaf.push(masa);
					jumlahf.push(parseInt(jml));
				})
				grafiktahunan(masaf, jumlahf);
				$("#modalgrafik").modal({backdrop: 'static', keyboard: false})
			}else{
				swal({title: "Gagal", text: "Data Grafik Tidak Tersedia", icon: "info"});
			}
		})
	}
	function grafiktahunan(masaf, jumlahf) {
		Highcharts.chart('blokgrafik2', {
			chart: {type: 'areaspline'},
			title: {text: "Grafik Penjualan Per Tahun"},
			subtitle: {text: ''},
			xAxis: {categories: masaf, crosshair: true},
			yAxis: {min: 0, title: {text: ''}},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' + '<td style="padding:0"><b>{point.y:0f} Transaksi</b></td></tr>',
				footerFormat: '</table>',
				shared: true, useHTML: true
			},
			plotOptions: {
				column: {pointPadding: 0.2, borderWidth: 0, dataLabels: {enabled: true}}
			},
			series: [{name: "Periode", data: jumlahf}]
		});
	}
</script>