function edit(res) {
    var html = "";

    html += `
        <div class="row">
            <div class="form-group col-12">
                <label for="input-asal-tujuan">Asal Tujuan Surat</label>
                <input type="hidden" name="id" value="${res['id_asal_tujuan']}">
                <textarea name="asal_tujuan" id="input-asal-tujuan" cols="30" rows="5" class="form-control">${res['asal_tujuan']}</textarea>
                <span class="text-danger"></span>
            </div>
            <div class="form-group col-12">
                <label for="input-asal-tujuan">Input Alamat</label>
                <textarea name="alamat" id="input-alamat" cols="30" rows="5" class="form-control">${res['alamat']}</textarea>
                <span class="text-danger"></span>
            </div>
        </div>
    `
    $('#form-update .modal-body').html(html)
}


$(document).ready(function () {
    
    $(document).on('keyup','#input-asal-tujuan', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur','#input-asal-tujuan', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })

    $(document).on('keyup','#input-alamat', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur','#input-alamat', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })

    // add
    $(document).on("click", ".btn-add", function(e) {
        $('#modal-add').modal("show")
    })
    $(document).on('submit','#modal-add #form-submit', function(e) {
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

        if(valid) {
            loading()
            $('#modal-add').modal("hide")
            $.ajax({
                type: "POST",
                url: baseUrl+"asaltujuan/add",
                data: $(this).serialize(),
                dataType: "json",
                success: function (res) {
                    loadingClose()
                    if(res['success'] == true) {                        
                        toastNotify(res['msg'])
                        document.getElementById("form-submit").reset();
                        $("#dataTableServer").DataTable().draw(true);                           
                    }
                    else toastNotify(res['msg'],0)
                },
                error: function (res) {
                    console.log(res['responseJSON'])
                },
                failure: function (res) {
                    console.log("failure")
                }
            }) 
            
            

        }           
    })

    // edit
    $(document).on("click", ".btn-edit", function(e) {
        var id = $(this).attr('data-id')
        loading()
        $.ajax({
            type: "GET",
            url: baseUrl+"asaltujuan/edit/"+id,
            dataType : "json",
            success : function(res) {
                loadingClose()
                if(res['success']== true) {
                    edit(res['data'])
                    $('#modal-edit').modal('show')
                }
                else {
                    console.log(res)
                }
            }
        })
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

        if(valid) {
            loading()
            $('#modal-edit').modal("hide")
            $.ajax({
                type: "POST",
                url: baseUrl+"asaltujuan/edit",
                data: $(this).serialize(),
                dataType: "json",
                success: function (res) {
                    loadingClose()
                    if(res['success'] == true) {                        
                        toastNotify(res['msg'])
                        $("#dataTableServer").DataTable().draw(true);           
                    }
                    else toastNotify(res['msg'],0)
                },
                error: function (res) {
                    console.log(res['responseJSON'])
                },
                failure: function (res) {
                    console.log("failure")
                }
            }) 
            
            

        }           
    })

    // delete
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
        loading()
        $.ajax({
            url: baseUrl+"asaltujuan/delete",
            type: "POST",
            data: {'id':id},
            dataType: "json",
            success: function (res) {
                loadingClose()
                if(res['success'] == true) {
                    toastNotify(res['msg'])
                    $("#dataTableServer").DataTable().draw(true);   
                }
                else toastNotify(res['msg'],0)
            }
        })
    })

    
})