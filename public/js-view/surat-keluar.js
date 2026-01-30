$(document).ready(function () {
    
    $(document).on('keyup','#input-bagian', function() {
        let val = $(this).val()
        if(val.length > 0) validateAjaxGet(baseUrl+"pimpinan/cekbagian/"+val, "#input-bagian")
        else error(this, "*wajib diisi")
    }).on('blur','#input-bagian', function() {
        let val = $(this).val()
        if(val.length > 0) validateAjaxGet(baseUrl+"pimpinan/cekbagian/"+val, "#input-bagian")
        else error(this, "*wajib diisi")
    })

       
    



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