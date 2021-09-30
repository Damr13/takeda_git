			<div class="main-content">
				<div class="container-fluid">
					<div class="page-header">
						<div class="row align-items-end">
							<div class="col-lg-12">
								<div class="page-header-title" style="text-align: center;">
									<div class="d-inline">
										<h5>Survey List (Raw Data) <div id="bulan_name" style="font-size: 15px;	font-weight: 600;margin-top: 7px;"></div> </h5>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 row align-items-end" style="margin-bottom:10px;">
							<div class="col-lg-2 col-md-12 col-sm-12">
								<label class="font-noraml" style="font-weight:bold">Category :</label>
								<div class="input-group">
									<select class="select2_demo_1 form-control" id="selectCat" onchange="changeTable()">
										<option value="visitor">Visitor</option>
										<option value="contractor">Contractor</option>
										<option value="employee">Employee</option>
										<option value="outsourcing">Outsourcing</option>
									</select>
								</div>
							</div>
							<div class="col-lg-2">
								<div class='form-group' style='width:100% !important'>
									<label for="date">Periode : </label>
									<input id="bulan" name="date" readonly="" class="form-control"> 
								</div>
							</div>
							<div class="col-lg-2">
								<div class='form-group' style='width:100% !important'>
									<button id="btn_cari" class='btn btn-search-ehs' onclick="cari()">Search <i class='ik ik-search'></i></button>
									<div class="spinner-border text-danger" id="spinner" role="status" style="display:none"></div>
								</div>        
							</div>
							<div class="col-lg-2">
								<div class='form-group' style='width:100% !important'>
									<button class='btn btn-excel-ehs' onclick="d_excel()"><i class='fa fa-file-excel-o'></i></button>
									<!-- <button class='btn btn-danger btn-lg' onclick="d_pdf()"><i class='fa fa-file-pdf-o'></i></button> -->
								</div>
							</div>
						</div>
						<!-- Visitor -->
						<div id="visitor_table" class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<table id="table_visitor" class="main-table table table-striped table-bordered table-hover table-responsive table-scroll" style="overflow:auto">
										<thead>
											<tr>
												<th><center><b>No</b></center></th>
												<th><center><b>Tanggal</b></center></th>
												<th><center><b>Nama</b></center></th>
												<th><center><b>Perusahaan/Instansi</b></center></th>
												<th><center><b>Alamat Domisili</b></center></th>
												<th><center><b>Tujuan kedatangan</b></center></th>
												<th><center><b>Sebelum berkunjung/ datang ke Takeda apakah Anda mengunjungi atau bekerja di tempat lain dimana terdapat kasus positif COVID-19?</b></center></th>
												<th><center><b>Jika jawaban diatas dijawab Ya jelaskan kapan Anda berkunjung atau Bekerja pada tempat tersebut!</b></center></th>
												<th><center><b>Berapa suhu badan anda hari ini?</b></center></th>
												<th><center><b>Demam (Suhu tubuh > 37.5 C)</b></center></th>
												<th><center><b>Pilek</b></center></th>
												<th><center><b>Batuk</b></center></th>
												<th><center><b>Kesulitan Bernafas</b></center></th>
												<th><center><b>Sakit Tenggorokan</b></center></th>
												<th><center><b>Menggigil</b></center></th>
												<th><center><b>Mual/Muntah</b></center></th>
												<th><center><b>Kejang</b></center></th>
												<th><center><b>Sakit Kepala</b></center></th>
												<th><center><b>Hilang Indera Perasa</b></center></th>
												<th><center><b>Hilang Indera Penciuman</b></center></th>
												<th><center><b>Sakit persendian - Sakit otot</b></center></th>
												<th><center><b>Diare</b></center></th>
												<th><center><b>Ruam</b></center></th>
												<th><center><b>Kelelahan - Lemah</b></center></th>
												<th><center><b>Konjungtivitis (Mata merah/iritasi)</b></center></th>
												<th><center><b>Hidung berdarah</b></center></th>
												<th><center><b>Penurunan kesadaran</b></center></th>
												<th><center><b>Kehilangan nafsu makan</b></center></th>
												<th><center><b>Gejala neurologis</b></center></th>
												<th><center><b>Apakah Anda melakukan perjalanan keluar KOTA DOMISILI Anda berada saat ini dalam 14 hari kebelakang?</b></center></th>
												<th><center><b>Jika pertanyaan diatas dijawab Ya tuliskan nama kota  perjalanan dilakukan!</b></center></th>
												<th><center><b>Apakah Anda melakukan close contact dengan pasien terkonfirmasi positif COVID-19 dalam waktu 14 hari terakhir? (Jika jawaban dipilih Ya info ke security yang bertugas atau Orang Takeda yang akan dikunjungi sebelum masuk)</b></center></th>
												<th><center><b>Berkaitan dengan pertanyaan diatas, Bagaimana hasil test COVID Anda (PCR atau Antigen)?</b></center></th>
												<th><center><b>Tuliskan gejala lain yang dirasakan selain gejala diatas</b></center></th>
												<th><center><b>Tulis tanggal perjalanan</b></center></th>
												<th><center><b>Apakah terdapat anggota keluarga yang tinggal 1 rumah yang sedang  sakit?</b></center></th>
												<th><center><b>Jelaskan secara singkat kondisi sakit tersebut dan apakah Anda close contact dengan orang yang sakit tersebut</b></center></th>
												<th><center><b>Ambil Foto</b></center></th>
											</tr>
										</thead>
										<tbody id="t_body_v">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- Contractor -->
						<div id="contractor_table" class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<table id="table_contractor" class="main-table table table-striped table-bordered table-hover table-responsive table-scroll" style="overflow:auto">
										<thead>
											<tr>
												<th><center><b>No</b></center></th>
												<th><center><b>Tanggal</b></center></th>
												<th><center><b>Nama</b></center></th>
												<th><center><b>Perusahaan/Instansi</b></center></th>
												<th><center><b>Alamat Domisili</b></center></th>
												<th><center><b>Sebelum berkunjung/ datang ke Takeda apakah Anda mengunjungi atau bekerja di tempat lain dimana terdapat kasus positif COVID-19?</b></center></th>
												<th><center><b>Berapa suhu badan anda hari ini?</b></center></th>
												<th><center><b>Demam (Suhu tubuh > 37.5 C)</b></center></th>
												<th><center><b>Pilek/Hidung Tersumbat</b></center></th>
												<th><center><b>Batuk</b></center></th>
												<th><center><b>Kesulitan Bernafas</b></center></th>
												<th><center><b>Sakit Tenggorokan</b></center></th>
												<th><center><b>Menggigil</b></center></th>
												<th><center><b>Mual/Muntah</b></center></th>
												<th><center><b>Kejang</b></center></th>
												<th><center><b>Sakit Kepala</b></center></th>
												<th><center><b>Hilang Indera Perasa</b></center></th>
												<th><center><b>Hilang Indera Penciuman</b></center></th>
												<th><center><b>Sakit persendian - Sakit otot</b></center></th>
												<th><center><b>Diare</b></center></th>
												<th><center><b>Ruam</b></center></th>
												<th><center><b>Kelelahan - Lemah</b></center></th>
												<th><center><b>Konjungtivitis (Mata merah/iritasi)</b></center></th>
												<th><center><b>Hidung berdarah</b></center></th>
												<th><center><b>Penurunan kesadaran</b></center></th>
												<th><center><b>Kehilangan nafsu makan</b></center></th>
												<th><center><b>Gejala neurologis</b></center></th>
												<th><center><b>Tuliskan gejala lain yang dirasakan selain gejala diatas</b></center></th>
												<th><center><b>Apakah Anda melakukan close contact dengan pasien terkonfirmasi positif COVID-19 dalam waktu 14 hari terakhir? (Jika jawaban dipilih Ya info ke security yang bertugas atau Orang Takeda yang akan dikunjungi sebelum masuk)</b></center></th>
												<th><center><b>Berkaitan dengan pertanyaan diatas, Bagaimana hasil test COVID Anda (PCR atau Antigen)?</b></center></th>
												<th><center><b>Apakah terdapat anggota keluarga yang tinggal 1 rumah yang sedang  sakit?</b></center></th>
												<th><center><b>Jelaskan secara singkat kondisi sakit tersebut dan apakah Anda close contact dengan orang yang sakit tersebut</b></center></th>
												<th><center><b>Apakah Anda melakukan perjalanan keluar KOTA DOMISILI Anda berada saat ini dalam 14 hari kebelakang?</b></center></th>
												<th><center><b>Jika pertanyaan diatas dijawab Ya tuliskan nama kota  perjalanan dilakukan!</b></center></th>
												<th><center><b>Tulis tanggal perjalanan</b></center></th>
												<th><center><b>Ambil Foto</b></center></th>
											</tr>
										</thead>
										<tbody id="t_body_c">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- Employee -->
						<div id="employee_table" class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<table id="table_employee" class="main-table table table-striped table-bordered table-hover table-responsive table-scroll" style="overflow:auto">
										<thead>
											<tr>
												<th><center><b>No</b></center></th>
												<th><center><b>Tanggal</b></center></th>
												<th><center><b>Nik</b></center></th>
												<th><center><b>Nama</b></center></th>
												<th><center><b>Berapa suhu badan anda hari ini?</b></center></th>
												<th><center><b>Demam (Suhu tubuh > 37.5 C)</b></center></th>
												<th><center><b>Pilek/Hidung Tersumbat</b></center></th>
												<th><center><b>Batuk</b></center></th>
												<th><center><b>Kesulitan Bernafas</b></center></th>
												<th><center><b>Sakit Tenggorokan</b></center></th>
												<th><center><b>Menggigil</b></center></th>
												<th><center><b>Mual/Muntah</b></center></th>
												<th><center><b>Kejang</b></center></th>
												<th><center><b>Sakit Kepala</b></center></th>
												<th><center><b>Hilang Indera Perasa</b></center></th>
												<th><center><b>Hilang Indera Penciuman</b></center></th>
												<th><center><b>Sakit persendian - Sakit otot</b></center></th>
												<th><center><b>Diare</b></center></th>
												<th><center><b>Ruam</b></center></th>
												<th><center><b>Kelelahan - Lemah</b></center></th>
												<th><center><b>Konjungtivitis (Mata merah/iritasi)</b></center></th>
												<th><center><b>Hidung berdarah</b></center></th>
												<th><center><b>Penurunan kesadaran</b></center></th>
												<th><center><b>Kehilangan nafsu makan</b></center></th>
												<th><center><b>Gejala neurologis</b></center></th>
												<th><center><b>Tuliskan gejala lain yang dirasakan selain gejala diatas</b></center></th>
												<th><center><b>Apakah Anda melakukan close contact dengan pasien terkonfirmasi positif COVID-19 dalam waktu 14 hari terakhir? (Jika jawaban dipilih Ya info ke security yang bertugas atau Orang Takeda yang akan dikunjungi sebelum masuk)</b></center></th>
												<th><center><b>Apakah terdapat anggota keluarga yang tinggal 1 rumah yang sedang  sakit?</b></center></th>
												<th><center><b>Jelaskan secara singkat kondisi sakit tersebut dan apakah Anda close contact dengan orang yang sakit tersebut</b></center></th>
												<th><center><b>Apakah Anda melakukan perjalanan keluar KOTA DOMISILI Anda berada saat ini dalam 14 hari kebelakang?</b></center></th>
												<th><center><b>Jika pertanyaan diatas dijawab Ya tuliskan nama kota  perjalanan dilakukan!</b></center></th>
												<th><center><b>Tulis tanggal perjalanan</b></center></th>
												<th><center><b>Lokasi bekerja hari ini</b></center></th>
												<th><center><b>Ambil Foto</b></center></th>
											</tr>
										</thead>
										<tbody id="t_body_e">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- Outsourcing -->
						<div id="outsourcing_table" class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<table id="table_outsourcing" class="main-table table table-striped table-bordered table-hover table-responsive table-scroll" style="overflow:auto">
										<thead>
											<tr>
												<th><center><b>No</b></center></th>
												<th><center><b>Tanggal</b></center></th>
												<th><center><b>Nik</b></center></th>
												<th><center><b>Nama</b></center></th>
												<th><center><b>Berapa suhu badan anda hari ini?</b></center></th>
												<th><center><b>Demam (Suhu tubuh > 37.5 C)</b></center></th>
												<th><center><b>Pilek/Hidung Tersumbat</b></center></th>
												<th><center><b>Batuk</b></center></th>
												<th><center><b>Kesulitan Bernafas</b></center></th>
												<th><center><b>Sakit Tenggorokan</b></center></th>
												<th><center><b>Menggigil</b></center></th>
												<th><center><b>Mual/Muntah</b></center></th>
												<th><center><b>Kejang</b></center></th>
												<th><center><b>Sakit Kepala</b></center></th>
												<th><center><b>Hilang Indera Perasa</b></center></th>
												<th><center><b>Hilang Indera Penciuman</b></center></th>
												<th><center><b>Sakit persendian - Sakit otot</b></center></th>
												<th><center><b>Diare</b></center></th>
												<th><center><b>Ruam</b></center></th>
												<th><center><b>Kelelahan - Lemah</b></center></th>
												<th><center><b>Konjungtivitis (Mata merah/iritasi)</b></center></th>
												<th><center><b>Hidung berdarah</b></center></th>
												<th><center><b>Penurunan kesadaran</b></center></th>
												<th><center><b>Kehilangan nafsu makan</b></center></th>
												<th><center><b>Gejala neurologis</b></center></th>
												<th><center><b>Tuliskan gejala lain yang dirasakan selain gejala diatas</b></center></th>
												<th><center><b>Apakah Anda melakukan close contact dengan pasien terkonfirmasi positif COVID-19 dalam waktu 14 hari terakhir? (Jika jawaban dipilih Ya info ke security yang bertugas atau Orang Takeda yang akan dikunjungi sebelum masuk)</b></center></th>
												<th><center><b>Apakah terdapat anggota keluarga yang tinggal 1 rumah yang sedang  sakit?</b></center></th>
												<th><center><b>Jelaskan secara singkat kondisi sakit tersebut dan apakah Anda close contact dengan orang yang sakit tersebut</b></center></th>
												<th><center><b>Apakah Anda melakukan perjalanan keluar KOTA DOMISILI Anda berada saat ini dalam 14 hari kebelakang?</b></center></th>
												<th><center><b>Jika pertanyaan diatas dijawab Ya tuliskan nama kota  perjalanan dilakukan!</b></center></th>
												<th><center><b>Tulis tanggal perjalanan</b></center></th>
												<th><center><b>Ambil Foto</b></center></th>
											</tr>
										</thead>
										<tbody id="t_body_o">
										
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>