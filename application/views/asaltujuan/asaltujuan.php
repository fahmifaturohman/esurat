<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <a href="#" class="btn btn-blue waves-effect waves-light btn-sm btn-add" data-toggle="modal">
                            <i class="ion-plus-circled m-r-5"></i> <span>Tambah</span> 
                            </a>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>asaltujuan"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Daftar Asal Tujuan Surat</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="dataTableServer" class="table dt-responsive table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>Asal Tujuan</th>
                                <th>Alamat</th>
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
				<p><h5>Apakah anda yakin ingin menghapus asal tujuan surat  <span class="text-modal"><span>?</h5></p>
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
				<h4 class="modal-title" id="myModalLabel-2">Tambah Asal Tujuan Surat</h4>
			</div>
            <form id="form-submit">           
			<div class="modal-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="input-asal-tujuan">Asal Tujuan Surat</label>
                        <textarea name="asal_tujuan" id="input-asal-tujuan" cols="30" rows="5" class="form-control"></textarea>
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="input-asal-tujuan">Alamat </label>
                        <textarea name="alamat" id="input-alamat" cols="30" rows="5" class="form-control"></textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                    <span class="btn-label"><i class="fa fa-save"></i> </span>Submit Asal Tujuan Surat
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
				<h4 class="modal-title" id="myModalLabel-2">Edit Asal Tujuan Surat</h4>
			</div>
            <form id="form-update">           
			<div class="modal-body">                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                    <span class="btn-label"><i class="fa fa-save"></i> </span>Update Asal Tujuan Surat
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
            iDisplayLength: 5,
            processing: true,
            responsive:true,
            serverSide: true,
            ordering: true,
            stateSave: false,
            order: [[ 1, 'desc' ]],
            ajax:
            {
                url: "<?= base_url('asaltujuan/table');?>",
                type: "POST"
            },
            deferRender: true,
            aLengthMenu: [[5, 10, 50, 100],[ 5, 10, 50, 100]],
            columns: [
                { data: function(data,type,dataToSet) {
                        str = `<td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a type="button" class="btn waves-effect waves-light btn-sm btn-primary btn-edit" data-toggle="modal" data-id="${data.id_asal_tujuan}"><i class="ion-edit"></i></a>
                                        <a type="button" class="btn waves-effect waves-light btn-sm btn-secondary btn-delete" data-toggle="modal" data-id="${data.id_asal_tujuan}" data-isi ="${data.asal_tujuan}"><i class="ion-trash-a"></i></a>
                                    </div>
                                </td>`
                        return str
                    }, orderable : false, width : "10px"
                },
                {
                    data: "id_asal_tujuan", sortable: false,  sClass: "text-center", orderable: false, searchable: false, width: "10px",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, orderable : false, width:"10px"  
                },
                {data: "asal_tujuan", orderable: false, width:"400px"},
                {data: "alamat", orderable: false},
            ],
        });
    });
</script>