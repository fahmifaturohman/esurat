<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <a href="#" class="btn waves-effect waves-light btn-md btn-purple btn-add" data-toggle="modal">
                            <i class="ion-plus-circled m-r-5"></i> <span>Tambah Klasifikasi Surat</span> 
                            </a>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>klasifikasi"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Daftar Klasifikasi Surat</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <!-- <h4 class="m-t-0 header-title">Default Example</h4>
                        <p class="text-muted font-14 m-b-30">
                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                        </p> -->
                        <table id="dataTableServer" class="table dt-responsive table-striped table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
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


<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel-2">Hapus Data</h4>
			</div>
			<div class="modal-body">
				<p><h5>Apakah anda yakin ingin menghapus klasifikasi surat <span class="text-modal"><span>?</h5></p>
				<input name="id" class="id" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-youtube waves-effect waves-light btn-delete-yes">
                    <span class="btn-label"><i class="fa fa-trash"></i> </span>Ya Hapus
                </button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-add" role="dialog" aria-labelledby="myModalLabel-2" data-backdrop="static">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel-2">Tambah Klasifikasi Surat</h4>
			</div>
            <form id="form-submit">           
			<div class="modal-body" style="overflow:auto;height:400px !important">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="input-kode">Kode Klasifikasi Surat</label>
                        <input type="text" name="kode" class="form-control" id="input-kode" autocomplete="off" maxlength="50">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="input-nama">Klasifikasi Surat</label>
                        <input type="text" name="nama" class="form-control" id="input-nama" autocomplete="off" maxlength="250">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="input-uraian">Deskripsi Klasifikasi Surat</label>
                        <textarea name="uraian" id="input-uraian" cols="30" rows="5" class="form-control"></textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                    <span class="btn-label"><i class="fa fa-save"></i> </span>Submit Klasifikasi Surat
                </button>
			</div>
            </form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-edit" role="dialog" aria-labelledby="myModalLabel-2" data-backdrop="static">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel-2">Edit Klasifikasi Surat</h4>
			</div>
            <form id="form-update">           
			<div class="modal-body" style="overflow:auto;height:400px !important">                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                    <span class="btn-label"><i class="fa fa-save"></i> </span>Update Klasifikasi Surat
                </button>
			</div>
            </form>
		</div>
	</div>
</div>



<script>
    var tabel = null;
    $(document).ready(function() {
        tabel = $('#dataTableServer').DataTable({
            "iDisplayLength": 5,
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true,
            "stateSave": false,
            "order": [[ 1, 'desc' ]],
            "ajax":
            {
                "url": "<?= base_url('klasifikasi/table');?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[5, 10, 50, 100],[ 5, 10, 50, 100]],
            "columns": [
                {"data": function(data,type,dataToSet) {
                        str = `<td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-primary btn-edit" data-toggle="modal" data-id="${data.id}"><i class="ion-edit"></i></a>
                                        <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-secondary btn-delete" data-toggle="modal" data-id="${data.id}" data-isi ="${data.nama}"><i class="ion-trash-a"></i></a>
                                    </div>
                                </td>`
                        return str
                    }, orderable : false
                },
                {
                    "data": 'id',"sortable": false,  "sClass": "text-center", "orderable": false, "searchable": false, "width": "10px",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, orderable : false  
                },
                {"data": "kode", "sortable":false, "sClass": "text-center", "orderable": false, "width": "10px"},
                {"data": "nama", "orderable": false},
                {"data": "uraian", "orderable": false},
            ],
        });
    });
</script>

