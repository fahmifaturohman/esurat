<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <a href="#" class="btn btn-dark waves-effect waves-light btn-sm btn-add">
                            <i class="ion-plus-circled m-r-5"></i> <span>Tambah Izin Keluar Kantor</span> 
                            </a>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>izinkeluar"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Izin Keluar Kantor Tahun <?=CURRENT_YEAR?></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable" class="table dt-responsive table-striped table-hover table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Keperluan</th>
                                <th>Izin</th> 
                                <th>Disetujui Oleh</th>
                                <td></td>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($data as $key ) { ?>
                                <tr>                                    
                                    <td><?=$no++;?></td>
                                    <td><?=$key->nama.' <b>('.$key->pegawai.')</b>'?></td>
                                    <td><?=$key->jabatan?></td>
                                    <td><?=$key->keperluan?></td>
                                    <td><?=strdateIndo($key->tgl_mengetahui).', '.$key->dari.' - '.$key->sampai?></td>
                                    <td><?=$key->ttd_nama?></td>
                                    <td><a href="<?=base_url('izinkeluar/print/').$key->id_izin?>" target="_blank" class="btn waves-effect waves-light btn-sm btn-info"><i class="ion-printer"></i></a></td>
                                    <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-facebook btn-edit" data-toggle="modal" data-id="<?=$key->id_izin?>" data-isi="<?=$key->nama?>"><i class="ion-compose"></i></a>
                                        <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-youtube btn-delete" data-toggle="modal" data-id="<?=$key->id_izin?>" data-isi="<?=$key->nama?>"><i class="ion-trash-a"></i></a>
                                    </div>
                                    </td>
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
				<h5 class="modal-title" id="myModalLabel-2">PERMOHONAN IZIN KELUAR KANTOR</h5>
			</div>
            <form id="form-submit">
                <div class="modal-body" style="overflow:auto;height:400px !important;">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="input-cari-pegawai" class="control-label">Kepada Yth :</label>                        
                            <input type="text" name="kepada" class="form-control typeahead input-penugas input-cari-jabatan required" placeholder="Ex: Kasubbag TURT" autocomplete="off">
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group col-12">
                            <label for="input-cari-pegawai" class="control-label">Pengaju
                                <input name="pegawai" class="radio-pegawai asn" type="radio" value="asn" checked> <span class="span-pegawai">ASN</span>
                                <input name="pegawai" class="radio-pegawai ppnpn" type="radio" value="ppnpn"> <span class="span-pegawai">PPNPN</span>
                            </label>                        
                            <input type="text" name="nama" class="form-control typehead input-nama input-cari-pegawai required" autocomplete="off">
                            <input type="hidden" class="input-nip" name="nip">
                            <input type="hidden" class="input-pangkat" name="pangkat">
                            <input type="hidden" class="input-jabatan" name="jabatan">
                            <input type="hidden" class="input-gambar" name="gambar">
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group col-12">
                            <label class="control-label">Jabatan</label>                        
                            <input type="text" class="form-control input-jabatan-label" readonly>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group col-6">
                            <label>Dari</label>
                            <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                <input type="text" name="dari" class="form-control input-dari" value="08:30">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Sampai</label>
                            <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                <input type="text" name="sampai" class="form-control input-sampai" value="16.00">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-12">
                            <label class="control-label">Keperluan</label> 
                            <textarea name="keperluan" class="form-control input-keperluan" cols="10" rows="3"></textarea>
                            <div class="text-danger"></div>
                        </div>

                        <div class="col-12"><hr></div>
                        <div class="form-group col-12">
                            <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                            <div class="input-group">
                                <input type="text" name="tgl" class="form-control input-tgl datepicker-autoclose required" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                </div>
                            </div>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group col-12" style="margin-bottom:60px">
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
                    <button type="submit" class="btn btn-instagram btn-blue waves-effect waves-light">
                        <span class="btn-label"><i class="fa fa-save"></i> </span>Submit Izin Keluar Kantor
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
				<h5 class="modal-title" id="myModalLabel-2">EDIT PERMOHONAN IZIN KELUAR KANTOR</h5>
			</div>
            <form id="form-edit">
                <div class="modal-body" style="overflow:auto;height:400px !important;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-instagram btn-blue waves-effect waves-light">
                        <span class="btn-label"><i class="fa fa-save"></i> </span>Update Izin Keluar Kantor
                    </button>
                </div>
            </form>
		</div>
	</div>
</div>



<script>
    function typeheadPegawai($els) {
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
                    if(res['type'] == "pegawai") {
                        $els.closest('#form-submit').find('.input-jabatan-label').val(data['jabatan'])
                        $els.closest('#form-submit').find('.input-jabatan').val(data['jabatan'])
                        $els.closest('#form-submit').find('.input-pangkat').val(data['pangkat']+' ('+data['golongan']+')')
                        $els.closest('#form-submit').find('.input-nip').val(data['username'])
                        $els.closest('#form-submit').find('.input-gambar').val(data['gambar'])
                    } else {
                        $els.closest('#form-submit').find('.input-jabatan-label').val(data['jabatan'])
                        $els.closest('#form-submit').find('.input-jabatan').val(data['jabatan'])
                        $els.closest('#form-submit').find('.input-gambar').val(data['gambar'])
                    }
                    success($('.input-jabatan-label'))
                });
            }
        })
    }

    function typeheadPegawaiEdit($els) {
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
                    if(res['type'] == "pegawai") {
                        $els.closest('#form-edit').find('.input-jabatan-label').val(data['jabatan'])
                        $els.closest('#form-edit').find('.input-jabatan').val(data['jabatan'])
                        $els.closest('#form-edit').find('.input-pangkat').val(data['pangkat']+' ('+data['golongan']+')')
                        $els.closest('#form-edit').find('.input-nip').val(data['username'])
                        $els.closest('#form-edit').find('.input-gambar').val(data['gambar'])
                    } else {
                        $els.closest('#form-edit').find('.input-jabatan-label').val(data['jabatan'])
                        $els.closest('#form-edit').find('.input-jabatan').val(data['jabatan']+' '+data['unit_kerja'])
                        $els.closest('#form-edit').find('.input-gambar').val(data['gambar'])
                    }
                    success($('.input-jabatan-label'))
                });
            }
        })
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
                    $elsValue.val(data['id'])
                });
            }
        })
    }

    function edit(data) {
        var html = "";
        var ppnpn = (data['pegawai'] == 'ppnpn') ? 'checked':''; 
        var asn = (data['pegawai'] == 'asn') ? 'checked':'';
        html += `
        <div class="row">
            <div class="form-group col-12">
                <label for="input-cari-pegawai" class="control-label">Kepada Yth :</label>  
                <input type="hidden" name="id" value="${data['id_izin']}">                      
                <input type="text" name="kepada" value="${data['kepada']}" class="form-control typeahead input-penugas input-cari-jabatan required" placeholder="Ex: Kasubbag TURT" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-12">
                <label for="input-cari-pegawai" class="control-label">Pengaju
                    <input name="pegawai" class="radio-pegawai asn" type="radio" value="asn" ${asn}> <span class="span-pegawai">ASN</span>
                    <input name="pegawai" class="radio-pegawai ppnpn" type="radio" value="ppnpn" ${ppnpn}> <span class="span-pegawai">PPNPN</span>
                </label>                        
                <input type="text" value="${data['nama']}" name="nama" class="form-control typehead input-nama input-cari-pegawai-edit required" autocomplete="off">
                <input type="hidden" class="input-nip" name="nip" value="${data['nip']}">
                <input type="hidden" class="input-pangkat" name="pangkat" value="${data['pangkat']}">
                <input type="hidden" class="input-jabatan" name="jabatan" value="${data['jabatan']}">
                <input type="hidden" class="input-gambar" name="gambar" value="${data['gambar']}">
                <input type="hidden" class="input-id-detail" name="id_detail" value="${data['id_izin_keluar_detail']}">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-12">
                <label class="control-label">Jabatan</label>                        
                <input type="text" class="form-control input-jabatan-label"  value="${data['jabatan']}" readonly>
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-6">
                <label>Dari</label>
                <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                    <input type="text" name="dari" class="form-control input-dari input-clock-edit"  value="${data['dari']}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group col-6">
                <label>Sampai</label>
                <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                    <input type="text" name="sampai" class="form-control input-sampai input-clock-edit"  value="${data['sampai']}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group col-12">
                <label class="control-label">Keperluan</label> 
                <textarea name="keperluan" class="form-control input-keperluan" cols="10" rows="3">${data['keperluan']}</textarea>
                <div class="text-danger"></div>
            </div>

            <div class="col-12"><hr></div>
            <div class="form-group col-12">
                <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                <div class="input-group">
                    <input type="text" name="tgl"  value="${data['tgl_mengetahui']}" class="form-control input-tgl-edit datepicker-autoclose required" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                    </div>
                </div>
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-12" style="margin-bottom:60px">
                <label for="" class="control-label">Mengetahui</label>
                <div class="input-group">
                    <input type="text"  value="${data['ttd_nama']}" class="form-control typehead input-cari-ttd required" placeholder="Mengetahui">
                    <input type="hidden" name="ttd"  value="${data['ttd']}" class="form-control typehead input-ttd" placeholder="Mengetahui">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-account-o"></i></span>
                    </div>
                </div>
            </div>
        </div>        
        `
        $('#modal-edit').find('.modal-body').html(html)
    }
</script>


<script>



     $(document).ready(function() { 

        $(document).on('keyup', '.input-cari-jabatan', function() {
            $(this).typeahead({
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

        $(document).on('keyup', '.input-penugas',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-penugas', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on('keyup', '.input-keperluan',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.keprluan', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on('change','.radio-pegawai', function(e) {
            if($(this).is(":checked")) {
            }
        })
        $(document).on('click', '.span-pegawai', function(e) {
           var isi = $(this).text()
           if(isi == "ASN") {
               $('.asn').prop("checked", true)
           } else {
                $(".ppnpn").prop("checked", true)
           }
        })

        $(document).on('keyup', '.input-cari-pegawai', function() {
            typeheadPegawai($(this))
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
            success($(this).closest('.petugas').find('.input-jabatan'))
        }).on('blur','.input-cari-pegawai', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on('click', '.input-clock-edit', function() {
            $('.clockpicker').clockpicker(); 
            success(this)
        });


        $(document).on('keyup','.input-cari-ttd', function() {            
            typeheadTtd($(this), $('.input-ttd'))
            if(($(this).val()).length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur', '.input-cari-ttd', function() {
            if(($(this).val()).length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on('click', '.input-tgl', function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight:'TRUE',
                autoclose: true,
            })
            success($(this))
        });


        //ADD
        $(document).on('click', '.btn-add', function() {
            let id = $(this).attr('data-id')
            $('#modal-add').modal('show')
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

            if(valid) postAjax("izinkeluar/add", "#form-submit", 0)
            history.go(0)
        })


        //DELETE
        $(document).on("click", ".btn-delete", function(e) {
            let id = $(this).attr('data-id')
            let name = $(this).attr('data-isi')
            $('#modal-delete').find('.id').val(id)
            $('#modal-delete').find('.text-modal').html(name)
            $('#modal-delete').modal('show')
        })
        $(document).on("click",".btn-delete-yes", function() {
            let id = $('#modal-delete').find('.id').val()
            var myurl = "izinkeluar/delete/"+id
            ajaxDelete(myurl)
        })


        //EDIT input-tgl-edit
        $(document).on('click', '.input-tgl-edit', function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight:'TRUE',
                autoclose: true,
            })
            success($(this))
        });
        $(document).on('keyup', '.input-cari-pegawai-edit', function() {
            typeheadPegawaiEdit($(this))
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
            success($(this).closest('.petugas').find('.input-jabatan'))
        }).on('blur','.input-cari-pegawai-edit', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).attr('data-id')
            $('#modal-edit').modal('show')
            loading()
            $.ajax({
                type: "GET",
                url : baseUrl+'izinkeluar/edit/'+id,
                dataType: "json",
                success: function(res) {
                    edit(res['data'])
                    loadingClose()
                }
            })
        })

        $(document).on("submit", "#form-edit", function(e) {
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

            if(valid) postAjax("izinkeluar/edit", "#form-edit")
        })





     });
</script>
