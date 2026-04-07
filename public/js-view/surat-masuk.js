
function resetFrom(id) {
    $('#form-add')[0].reset(); 
    $('#form-add').find('input, textarea, select').each(function() { success(this)})
    $('#input-sifat').val(id)
    if(id == 'rahasia') {
        $('#form-rahasia').removeClass('none')
        $('#form-biasa').addClass('none')
        $('#form-biasa').removeClass('active-form')
        $('#form-rahasia').addClass('active-form')
    } else {
        $('#form-rahasia').addClass('none')
        $('#form-biasa').removeClass('none')
        $('#form-biasa').addClass('active-form')
        $('#form-rahasia').removeClass('active-form')
    }
}

$(document).ready(function () {

    $(document).on('change','.check-input-manual', function(){
        if($(this).is(':checked')) {
            $('#input-no-agenda').removeAttr('readonly').val($(this).val()).focus()
        } else {
            $('#input-no-agenda').attr('readonly', 'readonly')
        }
    })

    $('.select2-kode').select2({
        closeOnSelect: true,
        ajax : {
            dataType: 'json',
              url: baseUrl+'klasifikasi/cariklasifikasi',
              delay: 800,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item['kode']+' - '+item['nama'],
                            id: item['id']
                        }
                    })
                };
            }
        }
    });
       
    $('.select2-asal-surat').select2({
        closeOnSelect: true,
        ajax : {
            dataType: 'json',
              url: baseUrl+'asaltujuan/cariTujuan',
              delay: 800,
              data: function(asal) {
                return {
                  search: asal.term
                }
              },
              processResults: function (data) {
                return {
                    results: $.map(data['data'], function (item) {
                        return {
                            text: item['asal_tujuan']+' - '+item['alamat'],
                            id: item['id_asal_tujuan']
                        }
                    })
                };
            }
        }
    });

    $('.select2-tujuan-surat').select2({
        closeOnSelect: true,
        ajax : {
            dataType: 'json',
              url: baseUrl+'asaltujuan/cariTujuan',
              delay: 800,
              data: function(tujuan) {
                return {
                  search: tujuan.term
                }
              },
              processResults: function (data) {
                return {
                    results: $.map(data['data'], function (item) {
                        return {
                            text: item['asal_tujuan']+' - '+item['alamat'],
                            id: item['id_asal_tujuan']
                        }
                    })
                };
            }
        }
    });
       
    $(document).on('submit','#form-submit', function(e) {
        e.preventDefault()
        let valid = true
        
        $(this).find('input, textarea, select').each(function() {
            if(!$(this).val()) {
                error(this,"Silahkan lengkapi form !");
                valid= false;
            }

            if ($(this).hasClass('is-invalid')){
                valid = false;
            }
        })

        if(valid) postAjax("pimpinan/add", "#form-submit")
    })

    $(document).on('submit','#form-update', function(e) {
        e.preventDefault()
        let valid = true
        
        $(this).find('input, textarea, select').each(function() {
            if(!$(this).val()) {
                error(this,"Silahkan lengkapi form !");
                valid= false;
            }

            if ($(this).hasClass('is-invalid')){
                valid = false;
            }
        })

        if(valid) postAjax("pimpinan/edit", "#form-update")          
    })

    $(document).on("click",".btn-add", function(e) {
        let id = $('.btn-sifat.btn-success').attr('data-id')
        $('#modal-add').modal("show")
        resetFrom(id)
    })

    $(document).on("click", ".btn-delete", function(e) {
        let id = $(this).attr('data-id')
        $('#modal-delete').find('.id').val(id)
        $('#modal-delete').modal("show")
    })

    $(document).on("click", ".btn-delete-yes", function(e) {
        e.preventDefault()
        let id = $('.id').val()
        let valid = false
        $('#modal-delete').modal('hide')
        deleteAjax("suratmasuk/delete", ".btn-delete-yes", {'id':id})
        tabel.ajax.reload()
    })


    /*modal form surat masuk*/
    $(document).on('click', '.btn-sifat', function() {
        let id = $(this).attr('data-id')
        $(this).addClass('btn-success').removeClass('btn-secondary').siblings().removeClass('btn-success').addClass('btn-secondary')
        resetFrom(id)
    })
    $(document).on('click','.btn-agenda-auto', function() {
        $('.btn-agenda-manual').removeClass('btn-success').addClass('btn-outline-secondary')
        $('.btn-agenda-auto').addClass('btn-success').removeClass('btn-outline-secondary')
        success('#input-kode-agenda')
        $.ajax({
            url: baseUrl+'suratmasuk/getNoAgenda',
            method: "GET",
            dataType: "json",
            success: function(res) {
                $('#input-kode-agenda').attr('readonly', 'readonly').val(res['data'])
                $('#input-kode-agenda').val(res['data'])
            }
        })
    })
    $(document).on('click','.btn-agenda-manual', function() {
        $('.btn-agenda-auto').removeClass('btn-success').addClass('btn-outline-secondary')
        $('.btn-agenda-manual').removeClass('btn-outline-secondary').addClass('btn-success')
        $('#input-kode-agenda').removeAttr('readonly').val('').focus()
    })
    $(document).on('keyup','#input-kode-agenda', function() {
        let val = $(this).val()
        if(val.length > 0) validateAjaxGet(baseUrl+"suratmasuk/validnoagenda/"+val, "#input-kode-agenda")
        else error(this, "*wajib diisi")
    }).on('blur','#input-kode-agenda', function() {
        let val = $(this).val()
        if(val.length > 0) validateAjaxGet(baseUrl+"suratmasuk/validnoagenda/"+val, "#input-kode-agenda")
        else error(this, "*wajib diisi")
    })
    $(document).on('keyup','#input-nomor-surat, #input-tanggal-surat, #input-cari-asal-surat, #input-cari-tujuan-surat', function() {
        let val = $(this).val()
        if(val.length <= 0) error(this, "*wajib diisi")
        else success(this)
    }).blur('#input-nomor-surat, .datepicker-surat, #input-cari-asal-surat, #input-cari-tujuan-surat', function() {
        let val = $(this).val()
        if(val.length <= 0) error(this, "*wajib diisi")
        else success(this)
    }).change('#input-tanggal-surat', function(){
        success('#input-tanggal-surat')
    });
    $(".datepicker-surat" ).datepicker({
        format: 'dd/mm/yyyy', //
        autoclose: true,
    })

    let arrAsalTujuan = [];
    $('.input-asal-surat').typeahead({
        source: function (query, result) {
            $.ajax({
                url: baseUrl+"asaltujuan/cariTujuan/"+query,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    arrAsalTujuan = []
                    let asalTujuan = data['data'];
                    asalTujuan.forEach(el => {
                      arrAsalTujuan.push({
                            id: el['id_asal_tujuan'],
                            name: el['asal_tujuan']
                        });
                    });
                    result($.map(arrAsalTujuan, function (item) {
                        return item.name;
                    }));
                }
            });
        },afterSelect: function (item) {
            let selected = arrAsalTujuan.find(x => x.name === item)
                if (selected) {
                    $('#input-cari-asal-surat').val(selected.name)
                    $('#id_asal').val(selected.id)
                }
            }
    })
    
    let arrTujuan = [];
    $('.input-tujuan-surat').typeahead({
        source: function (query, result) {
            $.ajax({
                url: baseUrl+"asaltujuan/cariTujuanSurat/"+query,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    arrTujuan = []
                    let tujuan = data['data'];
                    tujuan.forEach(el => {
                       arrTujuan.push({
                            id: el['id_tujuan'],
                            name: el['nama_tujuan']
                       });
                    });
                    
                    //show autocomplete
                    result($.map(arrTujuan, function (item) {
                        return item.name;
                    }));
                }
            });
        }, afterSelect: function (item) {
            let selected = arrTujuan.find(x => x.name === item)
                if (selected) {
                    $('.active-form').find('#input-cari-tujuan-surat').val(selected.name)
                    $('.active-form').find('#id_tujuan').val(selected.id)
                }
        }
    })
     $(document).on('submit','#form-add', function(e) {
        e.preventDefault()
        let valid = true
        
        $(this).find('.active-form, .form-no-agenda').find('input, textarea, select').each(function() {
            if(!$(this).val()) {
                error(this,"Silahkan lengkapi form !");
                valid= false;
            }

            if ($(this).hasClass('is-invalid')){
                valid = false;
            }
        })

        if(valid) {
            postAjax("suratmasuk/add", "#form-add")
            $('#modal-add').modal("hide")
            tabel.ajax.reload()
        }
    })
    
    





    



    /* DISPOSISI MASUK */
    $(document).on("change", ".id-disposisi-bagian", function () {
        var val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "siliahkan pilih kesekretariatan atau kepaniteraan")
    })

    $(document).on("click", ".btn-disposisi-awal", function(e) {
        let id = $(this).attr('data-id')
        $('#modal-dispoisis-awal').find('.id').val(id)
        $('#modal-dispoisis-awal').modal("show")
    })
    $(document).on("click", ".btn-distribusi", function(e) {
        let id = $(this).attr('data-id')
        $('#modal-distribusi').find('.id').val(id)
        $('#modal-distribusi').modal("show")
    })
    $(document).on("submit", "#form-submit-disposisi-awal", function(e) {
        e.preventDefault()
        let valid = true        
        $(this).find('select').each(function() {
            if(!$(this).val()) {
                error(this,"Silahkan Pilih");
                valid= false;
            }

            if ($(this).hasClass('is-invalid')){
                valid = false;
            }
        })

        if(valid) {
            $('#modal-dispoisis-awal').modal("hide")
            postAjax("suratmasuk/disposisi", "#form-submit-disposisi-awal", "", 0)
        }
    })
    $(document).on("submit", "#form-submit-distribusi", function(e) {
        e.preventDefault()
        let valid = true        
        $(this).find('select').each(function() {
            if(!$(this).val()) {
                error(this,"Silahkan Pilih");
                valid= false;
            }

            if ($(this).hasClass('is-invalid')){
                valid = false;
            }
        })

        if(valid) {
            $('#modal-distribusi').modal("hide")
            postAjax("suratmasuk/disposisi", "#form-submit-distribusi", "", 0)
        }
    })

    $(document).on("click", ".btn-distribusi-pegawai", function(e) {
        let id = $(this).attr('data-id')
        let isi = $(this).attr('data-isi')
        $('#modal-distribusi-pegawai').find('#id').val(id)
        $('#modal-distribusi-pegawai').find('#id_surat_masuk').val(isi)
        $('#modal-distribusi-pegawai').modal("show")
    })    
    $(document).on('keyup','.input-id-pegawai', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur','.input-id-pegawai', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })
    $(document).on('keyup','#input-note', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur','#input-note', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }) 
    $(document).on('submit','#form-distribusi-pegawai', function(e) {
        e.preventDefault()
        let valid = true
        if(valid) postAjax("suratmasuk/distribusipegawai", "#form-distribusi-pegawai", "", 0)       
    })
    $('#input-cari-pegawai').typeahead({
        source: function (query, result) {
            $.ajax({
                url: baseUrl+"pimpinan/caripegawaidanjabatan/"+query,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    let pegawai = data['data'];
                    var arrPegawai = [];
                    pegawai.forEach(el => {
                        arrPegawai.push(el['nama']+' ('+el['jabatan']+')');
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