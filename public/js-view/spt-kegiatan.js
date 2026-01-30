
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
                <button type="button" class="form-control btn btn-youtube btn-hapus-petugas-kegiatan"><i class="ion-close-circled"></i> hapus</button>
            </div>
        </div>
        `;        
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

    //search semua pegawai dibawah pta
    function petugasAll(i = null) {
        var html = ""
        html += `
        <div class="row petugas">
            <div class="form-group col-5">
                <label for="" class="control-label">Petugas ${i}</label>
                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai-all" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-5">
                <label for="" class="control-label">Jabatan ${i}</label>
                <input type="text" name="jabatan[]" class="form-control input-jabatan" autocomplete="off">
                <input type="hidden" name="nip[]" class="form-control input-nip">
                <input type="hidden" name="pangkat[]" class="form-control input-pangkat">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-1 p-pt-20">
                <label for="" class="control-label text-white">-</label>
                <button type="button" class="form-control btn btn-outline-danger btn-hapus-petugas-kegiatan"><i class="ion-close-circled"></i></button>
            </div>
        </div>
        `;        
        return html;
    }
    function typeheadPetugasAll($els) {
        $els.typeahead({
            source: function (query, process) {
                $.ajax({
                    url: baseUrl+"pimpinan/caripegawaiAll/"+query,
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
                $.post(baseUrl+"pimpinan/caripegawairowAll", {nama:item}, function (res) {
                    var res = JSON.parse(res), data = res['data']
                    if(res['type'] == "pegawai") {
                        $els.closest('.petugas').find('.input-jabatan').val(data['jabatan'])
                        $els.closest('.petugas').find('.input-pangkat').val(data['pangkat']+' ('+data['golongan']+')')
                        $els.closest('.petugas').find('.input-nip').val(data['username'])
                    } else {
                        $els.closest('.petugas').find('.input-jabatan').val(data['jabatan']+' '+data['unit_kerja'])
                        $els.closest('.petugas').find('.input-pangkat').val('PPNPN')
                        $els.closest('.petugas').find('.input-nip').val('-')
                    }
                });
            }
        })
    }

    function typeheadTempat($els) {
        $els.typeahead({
            source: function (query, process) {
                $.ajax({
                    url: baseUrl+"asaltujuan/cariTujuan/"+query,
                    dataType: "json",
                    type: "GET",
                    success: function (data) {
                        let res = data['data']
                        var results = res.map(function(item) {
                            return item['asal_tujuan'];
                        });
                        return process(results);
                    }
                });
            },
            afterSelect: function (item) {
                $.post(baseUrl+"asaltujuan/cariTujuanRow", {tempat:item}, function (res) {
                    var res = JSON.parse(res), data = res['data']
                    $els.closest('.form-kegiatan').find('.input-tempat').val(data['asal_tujuan'])
                    $els.closest('.form-kegiatan').find('.input-alamat').val(data['alamat'])
                });
            }
        })
    }

    

    //spt kegiatan
    $(document).ready(function() {
        var i = 1;
        let modalKegiatan = $('#form-edit')
        $('.input-tanggal-kegiatan').val($('.hide-input-tanggal-kegiatan').val())
        
        /*ALL ABOUT SPT KEGIATAN*/
        //button//
        $(document).on("click", ".btn-spt-kegiatan", function(e) {
            let id = $(this).attr('data-id')
            modalKegiatan.find('.input-spt-tipe').val(id)
            modalKegiatan.modal("show")
        })
        $(document).on("click", ".btn-tambah-petugas-kegiatan", function(e) {
            i++;
            var html = petugas(i)
            modalKegiatan.find('.list-petugas').prepend(html)
        })
        $(document).on("click", ".btn-hapus-petugas-kegiatan", function(e) {
            let id = $(this).attr('data-id')
            if(id !== undefined) { $('#form-edit').find('.list-petugas-hapus').append(`<input type="hidden" name="id_spt_detail_hapus[]" value="${id}">`) }
            $(this).closest('.petugas').remove()
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
        $(document).on('keyup', '.input-tanggal-kegiatan',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tanggal-kegiatan', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-kegiatan',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-kegiatan', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-cari-tempat',function() {
            typeheadTempat($(this))
             let val = $(this).val()
             if(val.length > 0) success(this)
             else error(this, "*wajib diisi")
         }).on('blur','.input-cari-tempat', function() {
             typeheadTempat($(this))
             let val = $(this).val()
             if(val.length > 0) success(this)
             else error(this, "*wajib diisi")
         })
        $(document).on('keyup', '.input-dipa',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-dipa', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('change', '.input-tahun',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tahun', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
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
        $(document).on('change', '.input-tgl',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tgl', function() {
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


        $(document).on('change','.radio-dipa', function(e) {
            if($(this).is(":checked")) {
                if($(this).val() == "0") { 
                    modalKegiatan.find('.list-dipa').addClass('d-none') 
                    success('.input-dipa')
                    success('.input-tahun')
                }
                else modalKegiatan.find('.list-dipa').removeClass('d-none')
            }
        })

        $(document).on('click', '.span-dipa', function(e) {
            var isi = $(this).text()
            if(isi == "DIPA") {
                $('.dipa').prop("checked", true)
                modalKegiatan.find('.list-dipa').removeClass('d-none')
            } else {
                 $(".non-dipa").prop("checked", true)
                 modalKegiatan.find('.list-dipa').addClass('d-none') 
                 success('.input-dipa')
                 success('.input-tahun')
            }
            
         })


        $(document).on("submit", "#form-edit", function(e) {
            e.preventDefault();
            var valid = true
            $(this).find('.form-control.required').each(function() {
                if(!$(this).val()) {
                    error(this,"Silahkan lengkapi form !");
                    valid= false;
                }

                if ($(this).hasClass('is-invalid')){
                    valid = false;
                }
            })

            if(valid) postAjax("spt/edit_spt_kegiatan", "#form-edit")
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

        $(".input-dipa").select2({
        maximumSelectionLength: 3
        });
    })