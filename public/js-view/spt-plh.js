function petugas(i = null) {
    var html = ""
    html += `
    <div class="row petugas">
        <div class="form-group col-4">
            <label for="" class="control-label">Petugas</label>
            <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai required" autocomplete="off">
            <div class="text-danger"></div>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="" class="control-label">Jabatan</label>
            <input type="text" name="jabatan[]" class="form-control input-jabatan required" autocomplete="off">
            <input type="hidden" name="nip[]" class="form-control input-nip">
            <div class="text-danger"></div>
        </div>
        <div class="form-group col-md-3 col-sm-12">
            <label for="" class="control-label">Pangkat</label>   
            <input type="text" name="pangkat[]" class="form-control input-pangkat"">
            <div class="text-danger"></div>
        </div>
        <div class="form-group col-md-1 col-sm-12 p-pt-20">
            <label for="" class="control-label text-white">-</label>
            <button type="button" class="form-control btn btn-outline-danger btn-hapus-petugas-kegiatan"><i class="ion-close-circled"></i></button>
        </div>
    </div>
    `;        
    return html;
}

function tahap(i = null) {
    var html = ""
    html += `
    <div class="row tahap">
        <div class="form-group col-5">
            <label for="" class="control-label">Tahap ${i}</label>
            <input type="text" name="tahap[]" class="form-control input-tahap" autocomplete="off">
            <div class="text-danger"></div>
        </div>
        <div class="form-group col-5">
            <label for="" class="control-label">Tempat ${i}</label>
            <input type="text" name="tempat[]" class="form-control input-tempat" autocomplete="off">
            <div class="text-danger"></div>
        </div>
        <div class="form-group col-1 p-pt-20">
            <label for="" class="control-label text-white">-</label>  
            <button type="button" class="form-control btn btn-outline-danger btn-hapus-tahap"><i class="ion-close-circled"></i></button>                             
        </div>
    </div>
    `
    return html;
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

function typeheadPetugas($els) {
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
                    $els.closest('.petugas').find('.input-jabatan').val(data['jabatan'])
                    $els.closest('.petugas').find('.input-pangkat').val(data['pangkat']+' ('+data['golongan']+')')
                    $els.closest('.petugas').find('.input-nip').val(data['username'])
                } else {
                    $els.closest('.petugas').find('.input-jabatan').val(data['jabatan']+' '+data['unit_kerja'])
                    $els.closest('.petugas').find('.input-pangkat').val("PPNPN")
                    $els.closest('.petugas').find('.input-nip').val("-")
                }
            });
        }
    })
}



$(document).ready(function() {
    let modalplh = $('#form-edit')
    var j = 1

    $('.input-waktu').val($('.input-waktu-old').val())

    $(document).on("click", ".btn-spt-plh", function(e) {
        let id = $(this).attr('data-id')
        modalplh.find('.input-spt-tipe').val(id)
        modalplh.modal("show")
    })

    $(document).on('change', '.input-alasan', function() {
        let val = $(this).val()
        $(modalplh).find('.text-alasan').text(val)
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur','.input-alasan', function() {
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })

    $(document).on('change', '.input-plh', function() {
        let val = $(this).val()
        $(modalplh).find('.input-keterangan').text(val)
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur','.input-plh', function() {
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })

    $('.input-cari-jabatan').typeahead({
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

    $(document).on('keyup', '.input-cari-pegawai', function() {
        typeheadPetugas($(this))
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
        success($(this).closest('.petugas').find('.input-jabatan'))
    }).on('blur','.input-cari-pegawai', function() {
        let val = $(this).val()
        if(val.length > 0) success(this)
        else error(this, "*wajib diisi")
    })

    $(document).on('keyup','.input-cari-ttd', function() {            
        typeheadTtd($(this), $('.input-ttd'))
        if(($(this).val()).length > 0) success(this)
        else error(this, "*wajib diisi")
    }).on('blur', '.input-cari-ttd', function() {
        if(($(this).val()).length > 0) success(this)
        else error(this, "*wajib diisi")
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

        if(valid) postAjax("spt/edit_spt_plh", "#form-edit")
    })
})