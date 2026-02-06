<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <button class="btn btn-purple btn-md waves-effect waves-light btn-perbarui-pegawai-pta-siger">
                            <i class="ion-refresh m-r-5"></i> <span>Perbarui Data Pegawai by SIPPERADING</span> 
                            </button>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>pegawai"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Daftar Pegawai</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="dataTableServer" class="table dt-responsive table-striped table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama/Telp</th>
                                <th>Pangkat</th>
                                <th>Jabatan</th> 
                                <th>Satker</th>
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
				
				<h4 class="modal-title" id="myModalLabel-2">Non Aktif</h4>
			</div>
			<div class="modal-body">
				<p><h5>Apakah anda yakin ingin menonaktifkan <span class="text-modal"><span>?</h5></p>
				<input name="id" class="id" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-delete-yes">Yes</button>
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
            stateSave: true,
            order: [[ 1, 'ASC' ]],
            ajax:
            {
                url: "<?= base_url('pegawai/table');?>",
                type: "POST"
            },
            deferRender: true,
            aLengthMenu: [[5, 10, 50, 100],[ 5, 10, 50, 100]],
            columns: [
                {
                    data: "id", sortable: false,  sClass: "text-center", orderable: false, searchable: false, width: "10px",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, orderable : false  
                },
                {data: "nip", orderable: false, width:"100px"},
                {data: function(data, type) { return data.nama+'<br>'+'<span class="badge badge-success"> <span class="fa fa-whatsapp"></span> '+data.no_hp+'</span>'},
                    orderable: false, width:"250px"},
                {data: function(data, type) { return data.nama_golongan+" ("+data.golongan+")"}, orderable: false, width:"100px"},
                {data: "jabatan", orderable: false},
                {data: "nama_satker", orderable: false},
                
            ],
        });

        $(document).on('click', '.btn-perbarui-pegawai-pta', function() {
                loading()
                $.ajax({
                    type: "GET",
                    url: baseUrl+"pegawai/perbarui",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (res) {
                        loadingClose()
                        toastNotify(res['msg'])
                        $('#dataTableServer').DataTable().ajax.reload()
                    }
                }) 
            
        })

        $(document).on('click', '.btn-perbarui-pegawai-pta-siger', function() {
                loading()
                $.ajax({
                    type: "GET",
                    url: baseUrl+"pegawai/perbarui_by_siger",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (res) {
                        loadingClose()
                        toastNotify(res['msg'])
                        $('#dataTableServer').DataTable().ajax.reload()
                    }
                }) 
            
        })
    });
</script>