<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-primary btn-undangan" data-toggle="modal" data-id="spt kegiatan"><i class="ion-plus-circled m-r-5"></i>Undangan</a>
                            </div>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Kepegawaian</a></li>
                            <li class="breadcrumb-item"><a href="<?=base_url()?>undangan"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">List Undangan</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable" class="table dt-responsive table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Sifat</th>
                                <th>Perihal</th>
                                <th>Tanggal</th>
                                <th>Kepada</th>
                                <th>Mengetahui</th>
                                <th>Laporan</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($data as $key ) { ?>
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a type="button" class="btn waves-effect waves-light btn-sm btn-secondary btn-delete" data-toggle="modal" data-id="<?=$key->id_undangan?>"><i class="ion-trash-a"></i></a>
                                        </div>
                                    </td>
                                    <td><?=$no++;?></td>
                                    <td><?=$key->nomor?></td>                                    
                                    <td><?=$key->sifat?></td>
                                    <td><?=$key->hal?></td>
                                    <td><?=$key->tanggal?></td>
                                    <td><?=$key->kepada?></td>
                                    <td><?=$key->mengetahui?></td>
                                    <td><a href="<?=base_url("undangan/report/").$key->id_undangan?>" target ="_blank" class="btn waves-effect waves-light btn-sm btn-primary"><i class="ion-android-printer"></i></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->


        </div> <!-- container -->

    </div> <!-- content -->
</div>

<div class="modal fade" id="modal-spt-kegiatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel-2">TAMBAH SPT KEGIATAN</h4>
			</div>
            <form id="form-submit-kegiatan">
			<div class="modal-body" style="overflow:auto;height:400px !important">
                <div class="row">
                    <input type="hidden" name="spt_tipe" class="input-spt-tipe">
                    <div class="form-group col-6">
                        <label for="input-cari-pegawai" class="control-label">Ditugaskan Oleh</label>                        
                            <input type="text" name="penugas" class="form-control typeahead input-penugas input-cari-jabatan" placeholder="Ditugaskan oleh" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6">
                        <label for="input-cari-pegawai" class="control-label">Hari/Tanggal Kegiatan</label>
                        <!-- <input type="text" name="tgl_kegiatan" class="form-control input-tanggal-kegiatan datepicker-autoclose" placeholder="yyyy-mm-dd" autocomplete="off"> -->
                        <input type="text" name="tgl_kegiatan" class="form-control input-tanggal-kegiatan" placeholder="Waktu Kegiatan" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6">
                        <label for="" class="control-label">Kegiatan</label>
                        <input type="text" name="kegiatan" class="form-control input-kegiatan" placeholder="Kegiatan" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6">
                        <label for="" class="control-label">Tempat</label>
                        <input type="text" name="tempat" class="form-control input-tempat" placeholder="Tempat Kegiatan" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6">
                        <label for="" class="control-label">Dipa (Satuan Kerja)</label>
                        <input type="text" name="dipa" class="form-control input-dipa" placeholder="dipa" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6">
                        <label for="" class="control-label">Tahun Anggaran</label>
                        <div class="input-group">
                            <input type="text" name="tahun" class="form-control input-tahun datepicker-year" placeholder="Tahun" autocomplete="off" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="text-danger"></div>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="col-12 text-right">
                    <button type="button" class="form-control col-3 btn btn-outline-success btn-tambah-petugas-kegiatan"><i class="ion-plus-circled"></i> Tambah Petugas</button>
                    </div>
                    <div class="col-12 list-petugas">
                        <div class="row petugas">
                            <div class="form-group col-5">
                                <label for="" class="control-label">Petugas 1</label>
                                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai" autocomplete="off">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-5">
                                <label for="" class="control-label">Jabatan 1</label>
                                <input type="text" name="jabatan[]" class="form-control input-jabatan" autocomplete="off">
                                <input type="hidden" name="nip[]" class="form-control input-nip">
                                <input type="hidden" name="pangkat[]" class="form-control input-pangkat">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-1 p-pt-20">
                                <label for="" class="control-label text-white">-</label>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="form-group col-6">
                        <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                        <div class="input-group">
                            <input type="text" name="tgl" class="form-control input-tgl datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6" style="margin-bottom:60px">
                        <label for="" class="control-label">Mengetahui</label>
                        <div class="input-group">
                            <input type="text" class="form-control typehead input-cari-ttd" placeholder="Mengetahui">
                            <input type="hidden" name="ttd" class="form-control typehead input-ttd" placeholder="Mengetahui">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-o"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">TAMBAH</button>
			</div>
            </form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-spt-plh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel-2">TAMBAH SPT PLH</h4>
			</div>
            <form id="form-submit-plh">
			<div class="modal-body" style="overflow:auto;height:400px !important">
                <div class="row">
                    <input type="hidden" name="spt_tipe" class="input-spt-tipe">
                    <div class="form-group col-12">
                        <label for="input-cari-pegawai" class="control-label">Pejabat Yang Memberi Tugas :</label>                        
                            <input type="text" name="penugas" class="form-control typeahead input-penugas input-cari-jabatan" placeholder="Ditugaskan oleh" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="col-12"><hr></div>
                    <!-- <div class="col-12 text-right">
                    <button type="button" class="form-control col-3 btn btn-outline-success btn-tambah-petugas-kegiatan"><i class="ion-plus-circled"></i> Tambah Petugas</button>
                    </div> -->
                    <div class="col-12 list-petugas">
                        <div class="row petugas">
                            <div class="form-group col-6">
                                <label for="" class="control-label">Pejabat Yang diberi Tugas : </label>
                                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai" autocomplete="off">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="" class="control-label">Jabatan</label>
                                <input type="text" name="jabatan[]" class="form-control input-jabatan" autocomplete="off" readonly>
                                <input type="hidden" name="nip[]" class="form-control input-nip">
                                <input type="hidden" name="pangkat[]" class="form-control input-pangkat">
                                <div class="text-danger"></div>
                            </div>
                            <!-- <div class="form-group col-1 p-pt-20">
                                <label for="" class="control-label text-white">-</label>                               
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="input-cari-pegawai" class="control-label">Ditugaskan Sebagai :</label>
                        <select name="plh" class="form-control input-plh">
                            <option value="">-</option>
                            <option value="Ketua">Ketua</option>
                            <option value="Panitera">Panitera</option>
                            <option value="Sekretaris">Sekretaris</option>
                        </select>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6">
                        <label for="input-cari-pegawai" class="control-label">Waktu PLH :</label>
                        <input type="text" name="waktu" class="form-control input-waktu" placeholder="Waktu PLH" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="input-cari-pegawai" class="control-label">Keterangan :</label>
                        <div class="row">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>1. </td>
                                        <td>Surat Tugas ini dibuat karena <b><span class="input-keterangan"></span></b> Pengadilan Tinggi Agama Bandar Lampung sedang dinas luar</td>
                                    </tr>
                                    <tr>
                                        <td>2. </td>
                                        <td>Kepada Pejabat yang ditunjuk untuk dapat melaksanakan tugasnya sebagai Pelaksana Harian (Plh) <b><span class="input-keterangan"></span></b> Pengadilan Tinggi Agama Bandar Lampung dan melaporkan tugasnya kepada <span class="input-keterangan"></span> Pengadilan Tinggi Agama Bandar Lampung</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="form-group col-6">
                        <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                        <div class="input-group">
                            <input type="text" name="tgl" class="form-control input-tgl datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6" style="margin-bottom:60px">
                        <label for="" class="control-label">Mengetahui</label>
                        <div class="input-group">
                            <input type="text" class="form-control typehead input-cari-ttd" placeholder="Mengetahui">
                            <input type="hidden" name="ttd" class="form-control typehead input-ttd" placeholder="Mengetahui">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-o"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">TAMBAH</button>
			</div>
            </form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-spt-diklat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel-2">TAMBAH SPT DIKLAT</h4>
			</div>
            <form id="form-submit-diklat">
			<div class="modal-body" style="overflow:auto;height:400px !important">
                <div class="row">
                    <input type="hidden" name="spt_tipe" class="input-spt-tipe">
                    <div class="form-group col-6">
                        <label for="input-cari-pegawai" class="control-label">Berdasarkan Surat</label>                        
                            <input type="text" name="berdasarkan" class="form-control input-berdasarkan" placeholder="Berdasarkan" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-3">
                        <label for="input-cari-pegawai" class="control-label">Nomor</label>                        
                            <input type="text" name="nomor" class="form-control input-nomor" placeholder="Nomor" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-3">
                        <label for="input-cari-pegawai" class="control-label">Tanggal</label>
                        <input type="text" name="tgl_sumber" class="form-control input-tanggal-sumber datepicker-autoclose" placeholder="yyyy-mm-dd" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="input-cari-pegawai" class="control-label">Ditugaskan Oleh</label>                        
                            <input type="text" name="penugas" class="form-control typeahead input-penugas input-cari-jabatan" placeholder="Ditugaskan oleh" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="" class="control-label">Untuk Mengikuti</label>
                        <textarea name="perihal" id="" cols="30" rows="5" class="form-control input-perihal"></textarea>
                        <div class="text-danger"></div>
                    </div>
                    <div class="col-12"><hr><label>Menugaskan Saudara :</label></div>
                    <div class="col-12 text-right">
                    <button type="button" class="form-control col-3 btn btn-outline-success btn-tambah-petugas-kegiatan"><i class="ion-plus-circled"></i> Tambah Petugas</button>
                    </div>
                    <div class="col-12 list-petugas">
                        <div class="row petugas">
                            <div class="form-group col-5">
                                <label for="" class="control-label">Petugas 1</label>
                                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai-all" autocomplete="off">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-5">
                                <label for="" class="control-label">Jabatan 1</label>
                                <input type="text" name="jabatan[]" class="form-control input-jabatan" autocomplete="off">
                                <input type="hidden" name="nip[]" class="form-control input-nip">
                                <input type="hidden" name="pangkat[]" class="form-control input-pangkat">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-1 p-pt-20">
                                <label for="" class="control-label text-white">-</label>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="col-12 text-right">
                    <button type="button" class="form-control col-3 btn btn-outline-success btn-tambah-tahap"><i class="ion-plus-circled"></i> Tahap</button>
                    </div>
                    <div class="col-12 list-tahap">
                        <div class="row tahap">
                            <div class="form-group col-5">
                                <label for="" class="control-label">Tahap 1</label>
                                <input type="text" name="tahap[]" class="form-control input-tahap" autocomplete="off">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-5">
                                <label for="" class="control-label">Tempat</label>
                                <input type="text" name="tempat[]" class="form-control input-tempat" autocomplete="off">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-1 p-pt-20">
                                <label for="" class="control-label text-white">-</label>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="form-group col-6">
                        <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                        <div class="input-group">
                            <input type="text" name="tgl" class="form-control input-tgl datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6" style="margin-bottom:60px">
                        <label for="" class="control-label">Mengetahui</label>
                        <div class="input-group">
                            <input type="text" class="form-control typehead input-cari-ttd" placeholder="Mengetahui">
                            <input type="hidden" name="ttd" class="form-control typehead input-ttd" placeholder="Mengetahui">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-o"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">TAMBAH</button>
			</div>
            </form>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel-2">Hapus Data</h4>
			</div>
			<div class="modal-body">
				<p><h5>Apakah anda SPT ini ?</h5></p>
				<input name="id" class="id" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-delete-yes">Hapus</button>
			</div>
		</div>
	</div>
</div>



<script>
    function petugas(i = null) {
        var html = ""
        html += `
        <div class="row petugas">
            <div class="form-group col-5">
                <label for="" class="control-label">Petugas ${i}</label>
                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-5">
                <label for="" class="control-label">Jabatan ${i}</label>
                <input type="text" name="jabatan[]" class="form-control input-jabatan" autocomplete="off">
                <input type="hidden" name="nip[]" class="form-control input-nip">
                <input type="hidden" name="pangkat[]" class="form-control input-pangkat">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-1 p-pt-20">
                <label for="" class="control-label text-white">-</label>
                <button type="button" class="form-control btn btn-outline-danger btn-hapus-petugas-kegiatan"><i class="ion-close-circled"></i></button>
            </div>
        </div>
        `;        
        return html;
    }

    function tahap(i = null) {
        var html = ""
        html += `
        <div class="row tahap">
            <div class="form-group col-5">
                <label for="" class="control-label">Tahap ${i}</label>
                <input type="text" name="tahap[]" class="form-control input-tahap" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-5">
                <label for="" class="control-label">Tempat ${i}</label>
                <input type="text" name="tempat[]" class="form-control input-tempat" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-1 p-pt-20">
                <label for="" class="control-label text-white">-</label>  
                <button type="button" class="form-control btn btn-outline-danger btn-hapus-tahap"><i class="ion-close-circled"></i></button>                             
            </div>
        </div>
        `
        return html;
    }

    function typeheadTtd($els, $elsValue = "") {
        $els.typeahead({
            source: function (query, process) {
                $.ajax({
                    url: baseUrl+"pimpinan/caripegawai/"+query,
                    dataType: "json",
                    type: "GET",
                    success: function (data) {
                        let pegawai = data['data']
                        var results = pegawai.map(function(item) {
                            return item['nama'];
                        });
                        return process(results);
                    }
                });
            },
            afterSelect: function (item) {
                $.post(baseUrl+"pimpinan/caripegawairow", {nama:item}, function (res) {
                    var res = JSON.parse(res), data = res['data']
                    $elsValue.val(data['id_user'])
                });
            }
        })
    }

    function typeheadPetugas($els) {
        $els.typeahead({
            source: function (query, process) {
                $.ajax({
                    url: baseUrl+"pimpinan/caripegawai/"+query,
                    dataType: "json",
                    type: "GET",
                    success: function (data) {
                        let pegawai = data['data']
                        var results = pegawai.map(function(item) {
                            return item['nama'];
                        });
                        return process(results);
                    }
                });
            },
            afterSelect: function (item) {
                $.post(baseUrl+"pimpinan/caripegawairow", {nama:item}, function (res) {
                    var res = JSON.parse(res), data = res['data']
                    $els.closest('.petugas').find('.input-jabatan').val(data['jabatan']+' '+data['unit_kerja'])
                    $els.closest('.petugas').find('.input-pangkat').val(data['pangkat']+' ('+data['golongan']+')')
                    $els.closest('.petugas').find('.input-nip').val(data['username'])
                });
            }
        })
    }

    //search semua pegawai dibawah pta
    function petugasAll(i = null) {
        var html = ""
        html += `
        <div class="row petugas">
            <div class="form-group col-5">
                <label for="" class="control-label">Petugas ${i}</label>
                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai-all" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-5">
                <label for="" class="control-label">Jabatan ${i}</label>
                <input type="text" name="jabatan[]" class="form-control input-jabatan" autocomplete="off">
                <input type="hidden" name="nip[]" class="form-control input-nip">
                <input type="hidden" name="pangkat[]" class="form-control input-pangkat">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-1 p-pt-20">
                <label for="" class="control-label text-white">-</label>
                <button type="button" class="form-control btn btn-outline-danger btn-hapus-petugas-kegiatan"><i class="ion-close-circled"></i></button>
            </div>
        </div>
        `;        
        return html;
    }
    function typeheadPetugasAll($els) {
        $els.typeahead({
            source: function (query, process) {
                $.ajax({
                    url: baseUrl+"pimpinan/caripegawaiAll/"+query,
                    dataType: "json",
                    type: "GET",
                    success: function (data) {
                        let pegawai = data['data']
                        var results = pegawai.map(function(item) {
                            return item['nama'];
                        });
                        return process(results);
                    }
                });
            },
            afterSelect: function (item) {
                $.post(baseUrl+"pimpinan/caripegawairowAll", {nama:item}, function (res) {
                    var res = JSON.parse(res), data = res['data']
                    $els.closest('.petugas').find('.input-jabatan').val(data['jabatan']+' '+data['unit_kerja'])
                    $els.closest('.petugas').find('.input-pangkat').val(data['pangkat']+' ('+data['golongan']+')')
                    $els.closest('.petugas').find('.input-nip').val(data['username'])
                });
            }
        })
    }

    


    $(document).ready(function() {
        var i = 1;
        let modalKegiatan = $('#modal-spt-kegiatan')
        
        /*ALL ABOUT SPT KEGIATAN*/
        //button//
        $(document).on("click", ".btn-spt-kegiatan", function(e) {
            let id = $(this).attr('data-id')
            modalKegiatan.find('.input-spt-tipe').val(id)
            modalKegiatan.modal("show")
        })
        $(document).on("click", ".btn-tambah-petugas-kegiatan", function(e) {
            i++;
            var html = petugas(i)
            modalKegiatan.find('.list-petugas').prepend(html)
        })
        $(document).on("click", ".btn-hapus-petugas-kegiatan", function(e) {
           $(this).closest('.petugas').remove()
        })

        $(document).on('keyup', '.input-penugas',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-penugas', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-tanggal-kegiatan',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tanggal-kegiatan', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-kegiatan',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-kegiatan', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-tempat',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tempat', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-dipa',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-dipa', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('change', '.input-tahun',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tahun', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-cari-pegawai', function() {
            typeheadPetugas($(this))
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
            success($(this).closest('.petugas').find('.input-jabatan'))
        }).on('blur','.input-cari-pegawai', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('change', '.input-tgl',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tgl', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup','.input-cari-ttd', function() {            
            typeheadTtd($(this), $('.input-ttd'))
            if(($(this).val()).length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur', '.input-cari-ttd', function() {
            if(($(this).val()).length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on("submit", "#form-submit-kegiatan", function(e) {
            e.preventDefault();
            var valid = true
            $(this).find('input[type="text"], textarea, select').each(function() {
                if(!$(this).val()) {
                    error(this,"Silahkan lengkapi form !");
                    valid= false;
                }

                if ($(this).hasClass('is-invalid')){
                    valid = false;
                }
            })

            if(valid) postAjax("spt/add", "#form-submit-kegiatan")
        })


        $('.input-cari-jabatan').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: baseUrl+"pimpinan/cariJabatan/"+query,
                    dataType: "json",
                    type: "GET",
                    success: function (data) {
                        let pegawai = data['data'];
                        var arrPegawai = [];
                        pegawai.forEach(el => {
                            arrPegawai.push(el['bagian'])
                        });                        
                        //show autocomplete
                        result($.map(arrPegawai, function (item) {
                            return item;
                        }));
                    }
                });
            }            
        })     

    })

    $(document).ready(function() {
        let modalplh = $('#modal-spt-plh')
        var j = 1

        $(document).on("click", ".btn-spt-plh", function(e) {
            let id = $(this).attr('data-id')
            modalplh.find('.input-spt-tipe').val(id)
            modalplh.modal("show")
        })

        $(document).on('change', '.input-plh', function() {
            let val = $(this).val()
            $(modalplh).find('.input-keterangan').text(val)
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-plh', function() {
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        
        $(document).on("submit", "#form-submit-plh", function(e) {
            e.preventDefault();
            var valid = true
            $(this).find('input[type="text"], textarea, select').each(function() {
                if(!$(this).val()) {
                    error(this,"Silahkan lengkapi form !");
                    valid= false;
                }

                if ($(this).hasClass('is-invalid')){
                    valid = false;
                }
            })

            if(valid) postAjax("spt/add", "#form-submit-plh")
        })
    })

    $(document).ready(function() {
        var k = 1, l=1
        let modalDiklat = $('#modal-spt-diklat')
        
        /*ALL ABOUT SPT KEGIATAN*/
        //button//
        $(document).on("click", ".btn-spt-diklat", function(e) {
            let id = $(this).attr('data-id')
            modalDiklat.find('.input-spt-tipe').val(id)
            modalDiklat.modal("show")
        })
        $(document).on("click", ".btn-tambah-petugas-kegiatan", function(e) {
            k++;
            var html = petugasAll(k)
            modalDiklat.find('.list-petugas').prepend(html)
        })
        $(document).on("click", ".btn-hapus-petugas-kegiatan", function(e) {
           $(this).closest('.petugas').remove()
        })
        $(document).on("click", ".btn-tambah-tahap", function(e) {
            l++;
            var html = tahap(l)
            modalDiklat.find('.list-tahap').prepend(html)
        })
        $(document).on("click", ".btn-hapus-tahap", function(e) {
           $(this).closest('.tahap').remove()
        })
        $(document).on('keyup', '.input-berdasarkan',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-berdasarkan', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-nomor',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-nomor', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('change', '.input-tanggal-sumber',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tanggal-sumber', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-perihal',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-perihal', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-penugas',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-penugas', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-tahap',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tahap', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-tempat',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tempat', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on('keyup', '.input-cari-pegawai-all', function() {
            typeheadPetugasAll($(this))
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
            success($(this).closest('.petugas').find('.input-jabatan'))
        }).on('blur','.input-cari-pegawai-all', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on('change', '.input-tgl',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tgl', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        
        $(document).on('keyup','.input-cari-ttd', function() {            
            typeheadTtd($(this), $('.input-ttd'))
            if(($(this).val()).length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur', '.input-cari-ttd', function() {
            if(($(this).val()).length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on("submit", "#form-submit-diklat", function(e) {
            e.preventDefault();
            var valid = true
            $(this).find('input[type="text"], textarea, select').each(function() {
                if(!$(this).val()) {
                    error(this,"Silahkan lengkapi form !");
                    valid= false;
                }

                if ($(this).hasClass('is-invalid')){
                    valid = false;
                }
            })

            if(valid) postAjax("spt/add", "#form-submit-diklat")
        })


          

    })

    $(document).ready(function() {
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).attr('data-id')
            $('#modal-delete').modal('show')
            $('#modal-delete').find('.id').val(id)
        })

        $(document).on("click", ".btn-delete-yes", function(e) {
            e.preventDefault()
            let id = $('#modal-delete').find('.id').val()
            $('#modal-delete').modal('hide')
            postAjax("spt/delete", ".btn-delete-yes", {'id':id}, 0)
        })
    })

    
</script>