<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>ppnpn"><?=$title;?></a></li>
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
                        <table id="datatable" class="table dt-responsive table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>TTL</th>
                                <th>TMT</th>                           
                                <th>JABATAN</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($data as $key ) { ?>
                                <tr>                                    
                                    <td><?=$no++;?></td>
                                    <td><?=$key->nama?></td>
                                    <td><?=$key->tempat_lahir.', '.strdateIndo($key->tgl_lahir)?></td>
                                    <td><?=strdateIndo($key->tgl_jadi_pegawai)?></td>
                                    <td><?=$key->pangkat?></td>
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


<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel-2">Hapus PPNPN</h4>
			</div>
			<div class="modal-body">
				<p><h5>Apakah anda yakin ingin menghapus <span class="text-modal"><span>?</h5></p>
				<input name="id" class="id" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-youtube waves-effect waves-light btn-delete-yes">
                    <span class="btn-label"><i class="fa fa-trash"></i> </span>Ya Hapus
                </button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2" data-backdrop="static">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel-2">FORM TAMBAH PPNPN</h5>
			</div>
            <form id="form-submit">
                <div class="modal-body" style="overflow:auto;height:400px !important;">
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="control-label">Nama</label>                        
                            <input type="text" name="nama" class="form-control input-nama" placeholder="nama" autocomplete="off">
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group col-12">
                            <label class="control-label">Tempat</label>                        
                            <input type="text" name="tempat" class="form-control input-tempat" placeholder="Tempat" autocomplete="off">
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group col-12">
                            <label for="" class="control-label">Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="text" name="tgl_lahir" class="form-control input-tgl datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                </div>
                            </div>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group col-12">
                            <label class="control-label">Jabatan</label>                        
                            <input type="text" name="jabatan" class="form-control input-jabatan" placeholder="Jabatan" autocomplete="off">
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group col-12">
                            <label for="" class="control-label">TMT</label>
                            <div class="input-group">
                                <input type="text" name="tmt" class="form-control input-tmt datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                </div>
                            </div>
                            <div class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-instagram waves-effect waves-light">
                        <span class="btn-label"><i class="fa fa-save"></i> </span>Submit PPNPN
                    </button>
                </div>
            </form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2" data-backdrop="static">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel-2">FORM EDIT PPNPN</h5>
			</div>
            <form id="form-update">
                <div class="modal-body" style="overflow:auto;height:400px !important;">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-instagram waves-effect waves-light">
                        <span class="btn-label"><i class="fa fa-save"></i> </span>Update PPNPN
                    </button>
                </div>
            </form>
		</div>
	</div>
</div>


<script>
    function contentEdit(data) {
        var html = "";
        html += `
        <div class="row">
            <div class="form-group col-12">
                <label class="control-label">Nama</label>
                <input type="hidden" name="id" value="${data['id']}">                        
                <input type="text" name="nama" class="form-control input-nama" value="${data['nama']}" placeholder="nama" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-12">
                <label class="control-label">Tempat</label>                        
                <input type="text" name="tempat" class="form-control input-tempat" value="${data['tempat']}" placeholder="Tempat" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-12">
                <label for="" class="control-label">Tanggal Lahir</label>
                <div class="input-group">
                    <input type="text" name="tgl_lahir" class="form-control input-tgl-edit datepicker-autoclose" value="${data['tgl_lahir']}" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                    </div>
                </div>
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-12">
                <label class="control-label">Jabatan</label>                        
                <input type="text" name="jabatan" value="${data['jabatan']}" class="form-control input-jabatan" placeholder="Jabatan" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-12">
                <label for="" class="control-label">TMT</label>
                <div class="input-group">
                    <input type="text" name="tmt" value="${data['tmt']}" class="form-control input-tmt-edit datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                    </div>
                </div>
                <div class="text-danger"></div>
            </div>
        </div>`
        $('#modal-edit').find('.modal-body').html(html)
        $('#modal-edit').modal("show")
    }

    $(document).ready(function() {
        var i = 1;
        let modalAdd = $('#modal-add')
        
        /*ALL ABOUT SPT KEGIATAN*/
        //button//
        $(document).on("click", ".btn-add", function(e) {
            modalAdd.modal("show")
        })

        $(document).on('keyup', '.input-nama, .input-tempat, .input-jabatan',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','input-nama, .input-tempat, .input-jabatan', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on('change', '.input-tgl, .input-tmt',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tgl, .input-tmt', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on("submit", "#form-submit", function(e) {
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

            if(valid) postAjax("ppnpn/add", "#form-submit")
        })

        $(document).on("click", ".btn-edit", function(e) {
            let id = $(this).attr('data-id')
            $.ajax({
                type: "GET",
                url: baseUrl+'ppnpn/view/'+id,
                dataType: "json",
                success: function (res) {
                    if(res['success'] == true) contentEdit(res['data'])
                    else success(id)
                }
            })
        })

        $(document).on('change', '.input-tgl-edit, .input-tmt-edit',function() {
            let val = $(this).val()
            if(val.length > 0) {
                success(this)
                $('.datepicker-autoclose').datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight:'TRUE',
                    autoclose: true,
                })
            }
            else error(this, "*wajib diisi")
        }).on('blur','.input-tgl-edit, .input-tmt-edit', function() {
            let val = $(this).val()
            if(val.length > 0) {
                success(this)
                $('.datepicker-autoclose').datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight:'TRUE',
                    autoclose: true,
                })
            }
            else error(this, "*wajib diisi")
        })

        $(document).on("submit", "#form-update", function(e) {
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

            if(valid) postAjax("ppnpn/edit", "#form-update")
        })

        $(document).on("click", ".btn-delete", function(e) {
            let id = $(this).attr('data-id')
            let name = $(this).attr('data-isi')
            $('#modal-delete').find('.id').val(id)
            $('#modal-delete').find('.text-modal').html(name)
            $('#modal-delete').modal('show')
        })
        $(document).on("click",".btn-delete-yes", function() {
            let id = $('#modal-delete').find('.id').val()
            var myurl = "ppnpn/delete/"+id
            ajaxDelete(myurl)
        })
    })
</script>