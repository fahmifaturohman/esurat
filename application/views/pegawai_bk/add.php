<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url('pegawai')?>"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Form Input</h4>

                        <div class="row">
                            <div class="col-xl-12">
                                <form id = "form-submit">
                                    <div class="form-group">
                                        <label for="input-nama" class="control-label">Nama Pegawai</label>
                                        <input type="text" name="nama" class="form-control" id="input-nama" placeholder="" autocomplete="off">
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-nip" class="control-label">NIP</label>
                                        <input type="text" name="nip" class="form-control" id="input-nip" placeholder="" autocomplete="off">
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-telp" class="control-label">No HP (WhatsApp)</label>
                                        <input type="text" name="telp" class="form-control" id="input-telp" placeholder="" autocomplete="off">
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-jabatan" class="control-label">Jabatan</label><br>
                                        <input type="radio" value="0"> Pimpinan <br>
                                        <input type="radio" value="1"> Staff
                                        <div class="text-danger"></div>
                                    </div>
                                    
                                   
                                    <a href="<?=base_url('pimpinan')?>" class="btn btn-secondary">Cancel</a>                                   
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