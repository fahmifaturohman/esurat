
    
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
            <button type="button" class="form-control btn btn-youtube btn-hapus-tahap"><i class="ion-close-circled"></i> hapus</button>                             
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

  
    //search semua pegawai dibawah pta
    function petugasAll(i = null) {
        var html = ""
        html += `
        <div class="row petugas">
            <div class="form-group col-md-4 col-sm-12">
                <label for="" class="control-label">Petugas</label>
                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai-all required" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-md-4 col-sm-12">
                <label for="" class="control-label">Jabatan</label>
                <input type="hidden" name="id_spt_detail[]">
                <input type="text" name="jabatan[]" class="form-control input-jabatan required" autocomplete="off">
                <input type="hidden" name="nip[]" class="form-control input-nip">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-md-3 col-sm-12">
                <label for="" class="control-label">Pangkat</label>   
                <input type="text" name="pangkat[]" class="form-control input-pangkat">
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

    
    //spt diklat
    $(document).ready(function() {
        var k = 1, l=1
        let modalDiklat = $('#form-edit')
        
        //button//
        $(document).on("click", ".btn-tambah-petugas-kegiatan", function(e) {
            k++;
            var html = petugasAll(k)
            modalDiklat.find('.list-petugas').prepend(html)
        })
        $(document).on("click", ".btn-hapus-petugas-kegiatan", function(e) {
            let id = $(this).attr('data-id')
            if(id !== undefined) { $('#form-edit').find('.list-petugas-hapus').append(`<input type="hidden" name="id_spt_detail_hapus[]" value="${id}">`) }
            $(this).closest('.petugas').remove()           
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
        $(document).on('keyup', '.input-penugas',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-penugas', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })

        $(document).on('keyup', '.input-cari-pegawai-all', function() {
            typeheadPetugasAll($(this))
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
            success($(this).closest('.petugas').find('.input-jabatan'))
        }).on('blur','.input-cari-pegawai-all', function() {
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



        $(document).on("click", ".btn-tambah-tahap", function(e) {
            l++;
            var html = tahap(l)
            modalDiklat.find('.list-tahap').prepend(html)
        })
        $(document).on("click", ".btn-hapus-tahap", function(e) {
            $(this).closest('.tahap').remove()
            let id = $(this).attr('data-id')
            if(id !== undefined) { $('#form-edit').find('.list-tahap-hapus').append(`<input type="hidden" name="id_spt_diklat_detail_hapus[]" value="${id}">`) }
        })
        $(document).on('keyup', '.input-berdasarkan',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-berdasarkan', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-nomor',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-nomor', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('change', '.input-tanggal-sumber',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tanggal-sumber', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-perihal',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-perihal', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        
        $(document).on('keyup', '.input-tahap',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tahap', function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        })
        $(document).on('keyup', '.input-tempat',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-tempat', function() {
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

            if(valid) postAjax("spt/edit_spt_diklat", "#form-edit")
        })


          

    })