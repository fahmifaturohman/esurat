<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-dark btn-spt-diklat" data-toggle="modal" data-id="spt diklat"><i class="ion-plus-circled m-r-5"></i> SPT Diklat</a>
                            </div>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Kepegawaian</a></li>
                            <li class="breadcrumb-item"><a href="<?=base_url()?>">spt</a></li>
                            <li class="breadcrumb-item active"><?=$title;?> tahun <?=CURRENT_YEAR?></li>
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
                                <th>Berdasarkan</th>
                                <th>Menugaskan</th>
                                <th>Mengetahui</th>                                
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->


        </div> <!-- container -->

    </div> <!-- content -->
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
				<button type="submit" class="btn btn-instagram waves-effect waves-light">
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
                url: "<?= base_url('spt/table_spt_diklat');?>",
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
                    }, orderable : false,
                },              
                {"data": function(data, type, dataToSet) {
                        return `${data['nomor']}<br><b>penugas: </b>${data['penugas']}<br><b>ditetapkan: </b>${data['tgl']}`
                    }, orderable:false, width:"200px"
                },
                {data: "sumber", orderable: false, width:"250px"},
                {"data": function(data, type, dataToSet) {
                        return `<b>${data['peserta']}</b><br>mengikuti ${data['perihal_sumber']}`
                    }, orderable:false, width:"250px"
                },
                {data: "nama", orderable: false},                
            ],
        });
    });
</script>
