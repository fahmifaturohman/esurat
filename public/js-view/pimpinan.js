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

    $(document).on("click", ".btn-pegawai", function(e) {
        let id = $(this).attr('data-id')
        let isi = $(this).attr('data-isi')
        $('#modal-pegawai').find('#id').val(id)
        $('#modal-pegawai').find('#myModalLabel-2').text("Pilih Pejabat "+isi)
        $('#modal-pegawai').modal("show")
    })
    $(document).on('submit','#form-pegawai', function(e) {
        e.preventDefault()
        let valid = true
        if(valid) postAjax("pimpinan/addpegawai", "#form-pegawai", "", 0)       
    })


    //modal note
    $(document).on("keyup", "#input-note-modal", function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on("blur", "#input-note-modal", function () {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })
    $(document).on("click", ".btn-note", function(e) {
        let id = $(this).attr('data-id')
        let isi = $(this).attr('data-isi')
        $('#modal-note').find('.id').val(id)
        $('#modal-note').find('#myModalLabel-2').text(isi)
        $('#modal-note').modal("show")
    })
    $(document).on('submit','#form-note', function(e) {
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
        if(valid) postAjax("pimpinan/addnote", "#form-note", "", 0)     
    })


    $('.input-cari-pegawai').typeahead({
        source: function (query, result) {
            $.ajax({
                url: baseUrl+"pimpinan/caripegawai/"+query,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    let pegawai = data['data'];
                    var arrPegawai = [];
                    pegawai.forEach(el => {
                        arrPegawai.push(el['nama'])
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