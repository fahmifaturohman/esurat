<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                           <a href="#" class="btn btn-purple waves-effect waves-light btn-sm btn-add">
                            <i class="ion-plus-circled m-r-5"></i> <span>Tambah Surat Masuk</span> 
                            </a> 
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>suratmasuk"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Daftar Surat Masuk side</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->           
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box" style="font-size:11px !important">                       
                        <table id="dataTableServer" class="table dt-responsive table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                               <th>No</th>
                                <th>Tahun</th>
                                <th>No,Agenda,Tgl Surat/Perihal</th>
                                <th>Sifat/Asal Surat</th>
                                <th>Tujuan</th>
                                <th>Status</th>
                                <th>Aksi</th>                             
                            </tr>
                            </thead>
                            <tbody class="tbody-content">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->


        </div> <!-- container -->

    </div> <!-- content -->
</div>

<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" data-backdrop="static" aria-label="modal1">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="myModalLabel-2">FORM TAMBAH SURAT MASUK</h6>
			</div>
            <form id="form-add">
			<div class="modal-body">
                
                <div class="btn-group">
                    <button type="button" class="btn btn-sifat btn-success" data-id = "biasa">SURAT BIASA</button>
                    <button type="button" class="btn btn-sifat btn-secondary" data-id = "penting">SURAT PENTING</button>
                    <button type="button" class="btn btn-sifat btn-secondary" data-id = "segera">SURAT SEGERA</button>
                    <button type="button" class="btn btn-sifat btn-secondary" data-id = "rahasia"><b>SURAT RAHASIA</b></button>
                    <input type="hidden" id="input-sifat" value="biasa">
                </div>
                <p></p>
                <div class="row" id="form-rahasia">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="input-kode-agenda">Kode Agenda</label>
                            <div class="input-group">
                            <input type="text" class="form-control" name="kode_agenda" id="input-kode-agenda" placeholder="Masukkan kode agenda">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-agenda-auto" type="button"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-success btn-agenda-manual" type="button">Input Manual</button>
                            </div>
                            </div>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row" id="form-biasa">
                    <div class="col-12">
                        
                    </div>
                </div>

                <div class="form-group">
                    <label for="input-cari-pegawai">Pegawai</label>
                    <input type="hidden" name="id" id="id"> 
                    <input type="text" name="id_pegawai" class="form-control typeahead input-id-pegawai" id="input-cari-pegawai" placeholder="cari pegawai" autocomplete="off">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="input-note-modal">Catatan</label>
                    <textarea name="note" id="input-note" cols="30" rows="3" class="form-control"></textarea>
                    <span class="text-danger"></span>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Update</button>
			</div>
            </form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel-2">Hapus Data</h4>
			</div>
			<div class="modal-body">
				<p><h5>Apakah anda yakin ingin menghapus surat masuk  <span class="text-modal"><span>?</h5></p>
				<input name="id" class="id" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-delete-yes">Hapus</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel-2"></h4>
			</div>
            <form id="form-pegawai">
			<div class="modal-body">
                <div class="form-group">
                    <label for="input-cari-pegawai">Pegawai</label>
                    <input type="hidden" name="id" id="id"> 
                    <input type="text" name="id_pegawai" class="form-control typeahead input-id-pegawai" id="input-cari-pegawai" placeholder="cari pegawai" autocomplete="off">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="input-note-modal">Catatan</label>
                    <textarea name="note" id="input-note" cols="30" rows="3" class="form-control"></textarea>
                    <span class="text-danger"></span>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Update</button>
			</div>
            </form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel-2"></h4>
			</div>
            <form id="form-note">
			<div class="modal-body">
				<input name="id" class="id" type="hidden">
                <div class="form-group">
                    <label for="input-note">Catatan</label>
                    <textarea name="note" id="input-note-modal" cols="30" rows="3" class="form-control"></textarea>
                    <span class="text-danger"></span>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
			</div>
            </form>
		</div>
	</div>
</div>



<script>
    $(document).ready(function() {
        window.viewTable = $('#viewTable').DataTable({					
            "scrollY": 500,
            "iDisplayLength": 10,
            "pagingType": "full_numbers",
            "bJQueryUI":true,
            "bSort":false,
            "bPaginate":true
        }) 
        
        $(document).on('change','#input-tahun', function() {
            var val = $(this).val()
            $('.tbody-content').html(val)
        })
    })
</script>

<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#dataTableServer').DataTable({
            "iDisplayLength": 5,
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true,
            "order": [[ 0, 'desc' ]],
            "ajax":
            {
                "url": "<?= base_url('suratmasuk/table');?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[5, 10, 50, 100],[ 5, 10, 50, 100]],
            "columns": [
                {
                    "data": 'id',"sortable": false,  "sClass": "text-center", "orderable": false, "searchable": false, "width": "10px",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {"data": function (data,type,dataToSet) {return data.tahun},"orderable":false, "width":"10px"},
                {"data": function (data, type, dataToSet) { return data.no_surat+" <b>("+data.no_agenda+": "+data.tgl_surat+")</b>"+"<br/>"+data.perihal;}, "orderable": false},
                {"data": function (data, type, dataToSet) { return data.sifat_surat + "<br/>"+data.asal_tujuan;}, "orderable": false},
                {"data": "bagian"},
                {"data": function(data, type, dataToSet) {
                    return (data.status == 0) ? '<span class="badge badge-pill badge-danger">Belum</span>':'<span class="badge badge-pill badge-success">Sudah</span>'
                }},
                {"data": function(data,type,dataToSet) {
                        str = `<div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?=base_url("suratmasuk/edit/")?>${data.id}" type="button" class="btn waves-effect waves-light btn-sm btn-primary"><i class="ion-edit"></i></a>
                                    <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-secondary btn-delete" data-toggle="modal" data-id="${data.id}" data-isi ="${data.id}"><i class="ion-trash-a"></i></a>
                                    <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-dark btn-view"><i class="ion-ios7-eye"></i></a>
                                    <a href="<?=dirUpload()?>masuk/${data.file_surat}" class="btn waves-effect waves-light btn-sm btn-success" target="_blank" download="${data.file_surat}"><i class="ion-ios7-cloud-download"></i></a>
                                    <a href="<?=base_url("suratmasuk/disposisi/")?>${data.id}" type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light">Disposisikan</a>
                                </div>`
                        return str
                    }
                }
               
            ],
        });
    });
</script>