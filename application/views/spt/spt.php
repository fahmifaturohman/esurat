<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-blue btn-spt-kegiatan" data-toggle="modal" data-id="spt kegiatan"><i class="ion-plus-circled m-r-5"></i> SPT Kegiatan</a>
                                <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-orange-light btn-spt-plh" data-toggle="modal" data-id="spt plh"><i class="ion-plus-circled m-r-5"></i> SPT PLH</a>
                                <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-blue btn-spt-diklat" data-toggle="modal" data-id="spt diklat"><i class="ion-plus-circled m-r-5"></i> SPT Diklat</a>
                            </div>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Kepegawaian</a></li>
                            <li class="breadcrumb-item">spt tahun <?=CURRENT_YEAR?></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="dataTableServer" class="table dt-responsive table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Ditetapkan</th>
                                <th>Tgl</th>
                                <th>Peserta</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->


        </div> <!-- container -->

    </div> <!-- content -->
</div>

<div class="modal fade" id="modal-spt-kegiatan" role="dialog" aria-labelledby="myModalLabel-2" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel-2">TAMBAH SPT KEGIATAN</h4>
			</div>
            <form id="form-submit-kegiatan" class="form-kegiatan">           
			<div class="modal-body" style="overflow:auto;height:400px !important">
                <div class="row">
                    <input type="hidden" name="spt_tipe" class="input-spt-tipe">
                    <div class="form-group col-4">
                        <label for="input-cari-pegawai" class="control-label">Pejabat yang memberi tugas :</label>                        
                        <input type="text" name="penugas" class="form-control typeahead input-penugas input-cari-jabatan required" placeholder="contoh : Ketua" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-8">
                        <label for="input-cari-pegawai" class="control-label">Hari/Tanggal Kegiatan</label>
                        <input type="text" name="tgl_kegiatan" class="form-control input-tanggal-kegiatan input-daterange-datepicker required" placeholder="Waktu Kegiatan" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>   
                    <div class="form-group col-12">
                        <label for="" class="control-label">Tempat</label>
                        <input type="text" name="tempat" class="form-control typehead input-tempat input-cari-tempat required" placeholder="Tempat Kegiatan" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="" class="control-label">Alamat Tempat Kegiatan (optional)</label>
                        <textarea name="alamat" class="form-control input-alamat" autocomplete="on" cols="10" rows="3"></textarea>
                        <div class="text-danger"></div>
                    </div>           
                    <div class="form-group col-12">
                        <label for="" class="control-label">Kegiatan</label>
                        <textarea name="kegiatan" class="form-control input-kegiatan required" autocomplete="off" cols="10" rows="3"></textarea>
                        <div class="text-danger"></div>
                    </div>  
                    <div class="form-group col-12">
                        <div class="row">
                            <div class="col-2">
                                <input type="radio" name="dipa_status" class="control-label radio-dipa dipa" value="1" checked> 
                                <label for="" class="control-label span-dipa">DIPA</label>
                            </div>
                            <div class="col-2">
                                <input type="radio" name="dipa_status" class="control-label radio-dipa non-dipa" value="0"> 
                                <label for="" class="control-label span-dipa">NON DIPA</label>
                            </div>
                        </div>
                    </div>                  
                    <div class="form-group col-6 list-dipa">
                        <label for="" class="control-label">Dipa (Satuan Kerja)</label>
                        <div class="row col-12">
                            <select class="select2 form-control input-dipa" name="dipa">
                                <?php foreach ($data['dipa'] as $key ) { ?>
                                <option value="<?=$key?>"><?=$key?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                <?php } ?>
                            </select> 
                        </div>                 
                        <div class="text-danger"></div>
                    </div>

                    <div class="form-group col-6 list-dipa">
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
                                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai required" autocomplete="off">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="" class="control-label">Jabatan 1</label>
                                <input type="text" name="jabatan[]" class="form-control input-jabatan required" autocomplete="off">
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
                            <input type="text" name="tgl" class="form-control input-tgl datepicker-autoclose required" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-6" style="margin-bottom:60px">
                        <label for="" class="control-label">Mengetahui</label>
                        <div class="input-group">
                            <input type="text" class="form-control typehead input-cari-ttd required" placeholder="Mengetahui">
                            <input type="hidden" name="ttd" class="form-control typehead input-ttd" placeholder="Mengetahui">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-o"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                    <span class="btn-label"><i class="fa fa-save"></i> </span>Submit SPT Kegiatan
                </button>
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
                    <div class="form-group col-md-12 col-sm-12">
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
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="" class="control-label">Pejabat Yang diberi Tugas : </label>
                                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai" autocomplete="off">
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
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
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="input-cari-pegawai" class="control-label">Ditugaskan Sebagai :</label>
                        <select name="plh" class="form-control input-plh">
                            <option value="">-</option>
                            <option value="Ketua">Ketua</option>
                            <option value="Panitera">Panitera</option>
                            <option value="Sekretaris">Sekretaris</option>
                        </select>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="control-label">Waktu PLH :</label>
                        <input type="text" name="waktu" class="form-control input-waktu input-daterange-datepicker required" placeholder="Waktu Plh" autocomplete="off">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="input-cari-pegawai" class="control-label">Alasan Plh</label>                            
                        <select name="alasan" class="form-control input-alasan required">
                            <option value="dinas luar" selected>Dinas Luar</option>
                            <option value="cuti">Cuti</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="input-cari-pegawai" class="control-label">Keterangan :</label>
                        <div class="row">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>1. </td>
                                        <td>Surat Tugas ini dibuat karena <b><span class="input-keterangan"></span></b> Pengadilan Tinggi Agama Bandar Lampung sedang <b><span class="text-alasan">dinas luar</span></b></td>
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
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                        <div class="input-group">
                            <input type="text" name="tgl" class="form-control input-tgl datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6 col-sm-12" style="margin-bottom:60px">
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
				<button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                    <span class="btn-label"><i class="fa fa-save"></i> </span>Submit SPT PLH
                </button>
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
                            <input type="text" name="penugas" class="form-control typeahead input-penugas input-cari-jabatan" placeholder="contoh : Ketua" autocomplete="off">
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
				<button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                    <span class="btn-label"><i class="fa fa-save"></i> </span>Submit SPT Diklat
                </button>
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
				<p><h5><center>Apakah anda SPT ini ?</center></h5></p>
				<input name="id" class="id" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-youtube waves-effect waves-light btn-delete-yes">
                    <span class="btn-label"><i class="fa fa-trash"></i> </span>Ya Hapus
                </button>
			</div>
		</div>
	</div>
</div>



<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#dataTableServer').DataTable({
            iDisplayLength: 5,
            processing: true,
            responsive:true,
            serverSide: true,
            ordering: true,
            stateSave: false,
            order: [[ 1, 'DESC' ]],
            ajax:
            {
                url: "<?= base_url('spt/table');?>",
                type: "POST"
            },
            deferRender: true,
            aLengthMenu: [[5, 10, 50, 100],[ 5, 10, 50, 100]],
            columns: [
                {data: function(data,type,dataToSet) {
                        text = data.spt_tipe
                        str = `<div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?=base_url('spt/')?>edit_${text.replace(' ', '_')}/${data['id_spt']}" class="btn waves-effect waves-light btn-sm btn-facebook btn-edit"><i class="ion-compose"></i></a>
                                    <a type="button" class="btn waves-effect waves-light btn-sm btn-youtube btn-delete" data-toggle="modal" data-id="${data['id_spt']}"><i class="ion-trash-a"></i></a>
                                    <a href="<?=base_url("spt/report/")?>${data['id_spt']}" target ="_blank" class="btn waves-effect waves-light btn-sm btn-primary"><i class="ion-android-printer"></i></a>
                                </div>`
                        return str    }
                },
                {data: "id_spt", sortable: false,  sClass: "text-center", orderable: false, searchable: false, width: "10px",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, orderable : false 
                },              
                {"data": function(data, type, dataToSet) {
                        return `${data['spt_tipe']}<br>${data['nomor']}`
                    }, orderable:false, width:"150px"
                },
                {data: "ditetapkan", orderable: false, width:"100px"},
                {data: function(data, type) {
                        return `<b>Penugas : </b>${data['penugas']}<br>${data['tgl']}`
                    }, orderable:false, width:"150px"
                },
                {data: "peserta", orderable: false},                
            ],
        });
    });
</script>
