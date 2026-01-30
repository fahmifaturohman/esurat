<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url('suratmasuk')?>"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Form Edit</h4>

                        <div class="row">
                            <div class="col-xl-12">
                                <form id = "form-submit">
                                    <div class="row">

                                        <div class="col-md-4 col-sm-12">                                            
                                            <div class="form-group">
                                                <label for="input-no-agenda" class="control-label">Nomor Agenda</label>                                                
                                                <input type="text" name="no_agenda" value="<?=$next_number?>" class="form-control" id="input-no-agenda" autocomplete="off" >                                                                                                                                        
                                                <div class="text-danger"></div>                                                
                                            </div>
                                            <div class="form-group"> 
                                                <label>Asal Surat</label> 
                                                <select name="asal_surat" id="input-asal-surat" class="form-control select2 select2-asal-surat select2-hidden-accessible input-rahasia" tabindex="-1" aria-hidden="true">
                                                </select> 
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Surat</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" name="tgl_surat" class="form-control datepicker input-rahasia" id="input-tgl-surat">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                                        </div>
                                                        <span class="col-12 text-danger row"></span>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="input-file-surat">File Surat (PDF/DOC/DOCX File)</label>
                                                <input type="file" class="form-control input-rahasia input-file-surat" name="file_surat" id="input-file-surat" autocomplete="off">
                                                <span class="text-danger"></span>
                                            </div>                          
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="input-sifat-surat" class="control-label">Sifat Surat</label>
                                                <select name="sifat_surat" id="input-sifat-surat" class="form-control">
                                                    <?php 
                                                        $arr_sifat = ["Biasa", "Penting","Sangat Penting", "Segera", "Rahasia"];   
                                                        foreach ($arr_sifat as $key) {
                                                            $selected = ($key == $data['sifat_surat']) ? "selected":"";
                                                            echo 
                                                        }                                               
                                                    ?>
                                                    <option value="Biasa">Biasa</option>
                                                    <option value="Penting">Penting</option>
                                                    <option value="Sangat Penting">Sangat Penting</option>
                                                    <option value="Segera">Segera</option>
                                                    <option value="Rahasia"><b>RAHASIA</b></option>
                                                </select>
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="form-group"> 
                                                <label>Tujuan Surat</label> 
                                                <select name="tujuan" id="input-tujuan" class="form-control select2 select2-tujuan select2-hidden-accessible input-rahasia" tabindex="-1" aria-hidden="true">
                                                </select> 
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Terima Surat</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" name="tanggal_terima" class="form-control datepicker" id="input-tgl-terima">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                                        </div>
                                                        <span class="col-12 text-danger row"></span>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="input-perihal" class="control-label input-rahasia">Perihal</label>
                                                <textarea name="perihal" id="input-perihal" cols="30" rows="5" class="form-control input-rahasia"></textarea>
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="input-no-surat" class="control-label">Nomor Surat</label>
                                                <input type="text" name="no_surat" class="form-control input-rahasia" autocomplete="off" id="input-no-surat">
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="form-group"> 
                                                <label>Kode Surat</label> 
                                                <select name="kode_surat" id="input-kode-surat" class="form-control select2 select2-kode select2-hidden-accessible input-rahasia" tabindex="-1" aria-hidden="true">
                                                </select> 
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Indeks Berkas</label>
                                                <input type="text" class="form-control input-rahasia" name="indeks" id="input-indeks" autocomplete="off">
                                                <span class="text-danger"></span>
                                            </div>                                               
                                        </div>
                                    </div>                                
                                
                                    <a href="<?=base_url('suratmasuk')?>" class="btn btn-secondary">Cancel</a>                                   
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>
        </div> <!-- container -->

    </div> <!-- content -->
</div>