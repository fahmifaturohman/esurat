$(document).ready(function () {
    
    $(document).on('keyup','#input-username', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur','#input-username', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })
    $(document).on('keyup','#input-password', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur','#input-password', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })
    
    $(document).on('submit','#form-login', function(e) {
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
        if(valid) postAjaxLogin("login", "#form-login")
    })
    
})