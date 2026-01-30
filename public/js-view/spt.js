
    function petugas(i = null) {
        var html = ""
        html += `
        <div class="row petugas">
            <div class="form-group col-5">
                <label for="" class="control-label">Petugas ${i}</label>
                <input type="text" name="nama[]" class="form-control typehead input-nama input-cari-pegawai required" autocomplete="off">
                <div class="text-danger"></div>
            </div>
            <div class="form-group col-6">
                <label for="" class="control-label">Jabatan ${i}</label>
                <input type="text" name="jabatan[]" class="form-control input-jabatan required" autocomplete="off">
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

    //input tempat dan alamat untuk spt kegiatan
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
        let modalKegiatan = $('#modal-spt-kegiatan')
        
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

        $(document).on('submit','#modal-spt-kegiatan #form-submit-kegiatan', function(e) {
            e.preventDefault()
            let valid = true
            
            $(this).find('.form-control.required').each(function() {
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
                $('#modal-spt-kegiatan').modal("hide")
                $.ajax({
                    type: "POST",
                    url: baseUrl+"spt/add",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (res) {
                        loadingClose()
                        if(res['success'] == true) {                        
                            toastNotify(res['msg'])
                            document.getElementById("form-submit-kegiatan").reset();
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

        $(".input-dipa").select2({
        maximumSelectionLength: 3
        });
    })

    //spt plh
    $(document).ready(function() {
        let modalplh = $('#modal-spt-plh')
        var j = 1

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
        
        $(document).on("submit", "#form-submit-plh", function(e) {
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

            if(valid) postAjax("spt/add", "#form-submit-plh")
        })
    })

    //spt diklat
    $(document).ready(function() {
        var k = 1, l=1
        let modalDiklat = $('#modal-spt-diklat')
        
        /*ALL ABOUT SPT KEGIATAN*/
        //button//
        $(document).on("click", ".btn-spt-diklat", function(e) {
            let id = $(this).attr('data-id')
            modalDiklat.find('.input-spt-tipe').val(id)
            modalDiklat.modal("show")
        })
        $(document).on("click", ".btn-tambah-petugas-kegiatan", function(e) {
            k++;
            var html = petugasAll(k)
            modalDiklat.find('.list-petugas').prepend(html)
        })
        $(document).on("click", ".btn-hapus-petugas-kegiatan", function(e) {
           $(this).closest('.petugas').remove()
        })
        $(document).on("click", ".btn-tambah-tahap", function(e) {
            l++;
            var html = tahap(l)
            modalDiklat.find('.list-tahap').prepend(html)
        })
        $(document).on("click", ".btn-hapus-tahap", function(e) {
           $(this).closest('.tahap').remove()
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
        $(document).on('keyup', '.input-penugas',function() {
            let val = $(this).val()
            if(val.length > 0) success(this)
            else error(this, "*wajib diisi")
        }).on('blur','.input-penugas', function() {
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

        $(document).on("submit", "#form-submit-diklat", function(e) {
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

            if(valid) postAjax("spt/add", "#form-submit-diklat")
        })


          

    })

    //spt view
    $(document).ready(function() {
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).attr('data-id')
            $('#modal-delete').modal('show')
            $('#modal-delete').find('.id').val(id)
        })

        $(document).on("click", ".btn-delete-yes", function(e) {
            e.preventDefault()
            let id = $('.id').val()
            let valid = false
            $('#modal-delete').modal('hide')
            loading()
            $.ajax({
                url: baseUrl+"spt/delete",
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
