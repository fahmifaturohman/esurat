$(document).ready(function () {
    
    $(document).on('keyup','#input-no-agenda', function() {
        let val = $(this).val()
        if(val.length > 0) validateAjaxGet(baseUrl+"suratmasuk/validnoagenda/"+val, "#input-no-agenda")
        else error(this, "*wajib diisi")
    }).on('blur','#input-no-agenda', function() {
        let val = $(this).val()
        if(val.length > 0) validateAjaxGet(baseUrl+"suratmasuk/validnoagenda/"+val, "#input-no-agenda")
        else error(this, "*wajib diisi")
    })

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
        let id = $(this).attr('data-id')
        let isi= $(this).attr('data-isi')
        $('#modal-delete').find('.text-modal').text(isi)
        $('#modal-delete').find('.id').val(id)
        $('#modal-add').modal("show")
    })

    $(document).on("click", ".btn-delete", function(e) {
        let id = $(this).attr('data-id')
        let isi= $(this).attr('data-isi')
        $('#modal-delete').find('.text-modal').text(isi)
        $('#modal-delete').find('.id').val(id)
        $('#modal-delete').modal("show")
    })

    $(document).on("click", ".btn-delete-yes", function(e) {
        e.preventDefault()
        let id = $('.id').val()
        let valid = false
        $('#modal-delete').modal('hide')
        postAjax("pimpinan/delete", ".btn-delete-yes", {'id':id}, 0)
    })


    /*button*/

    $(document).on('click', '.btn-sifat', function() {
        let id = $(this).attr('data-id')
        $('#input-sifat').val(id)
        $(this).addClass('btn-success').removeClass('btn-secondary').siblings().removeClass('btn-success').addClass('btn-secondary')
    })
    $(document).on('click','.btn-agenda-auto', function() {
        $('.btn-agenda-manual').removeClass('btn-success').addClass('btn-outline-secondary')
        $('.btn-agenda-auto').addClass('btn-success').removeClass('btn-outline-secondary')
        $('#input-kode-agenda').attr('readonly', 'readonly').val('1')
    })
    $(document).on('click','.btn-agenda-manual', function() {
        $('.btn-agenda-auto').removeClass('btn-success').addClass('btn-outline-secondary')
        $('.btn-agenda-manual').removeClass('btn-outline-secondary').addClass('btn-success')
        $('#input-kode-agenda').removeAttr('readonly').val('').focus()
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