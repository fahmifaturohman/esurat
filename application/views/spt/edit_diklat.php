<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Kepegawaian</li>
                            <li class="breadcrumb-item"><a href="<?=base_url('spt')?>">SPT</a></li>
                            <li class="breadcrumb-item active"><?=$title?></li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0">Form Edit SPT PLH</h4>
                        <p class="text-muted font-13 m-b-10">
                           Sialahkan ada lakukan perubahan data SPT PLH
                        </p>
                        <div class="row">
                            <div class="col-12">
                                <form id ="form-edit" method="POST">
                                    <div class="row">
                                        <input type="hidden" name="spt_tipe" class="input-spt-tipe" value="spt diklat">
                                        <div class="form-group col-12">
                                            <label for="input-cari-pegawai" class="control-label">Berdasarkan Surat</label> 
                                            <input type="hidden" name="id_spt_diklat" value="<?=$data->id_spt_diklat?>">      
                                            <textarea name="berdasarkan" cols="30" rows="3" class="form-control input-berdasarkan"><?=$data->sumber?></textarea>    
                                            <div class="text-danger"></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="input-cari-pegawai" class="control-label">Ditugaskan Oleh</label>
                                                <input type="hidden" name="id_spt" value="<?=$spt->id_spt?>">                        
                                                <input type="text" value="<?=$spt->penugas?>" name="penugas" class="form-control typeahead input-penugas input-cari-jabatan" placeholder="Ditugaskan oleh" autocomplete="off">
                                            <div class="text-danger"></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="input-cari-pegawai" class="control-label">Tanggal</label>
                                            <input type="text" value="<?=$data->tgl_sumber?>" name="tgl_sumber" class="form-control input-tanggal-sumber datepicker-autoclose" placeholder="yyyy-mm-dd" autocomplete="off">
                                            <div class="text-danger"></div>
                                        </div>                                       
                                        <div class="form-group col-12">
                                            <label for="" class="control-label">Untuk Mengikuti</label>
                                            <textarea name="perihal" id="" cols="30" rows="5" class="form-control input-perihal"><?=$data->perihal_sumber?></textarea>
                                            <div class="text-danger"></div>
                                        </div>
                                        <div class="col-12"><hr><label>Menugaskan Saudara :</label></div>
                                        <div class="col-12 text-right">
                                        <button type="button" class="form-control col-3 btn btn-outline-success btn-tambah-petugas-kegiatan"><i class="ion-plus-circled"></i> Tambah Petugas</button>
                                        </div>
                                        <div class="col-12 list-petugas">
                                            <?php $no = 1; foreach ($detail as $key) { ?>                                        
                                            <div class="row petugas">
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label for="" class="control-label">Petugas</label>
                                                    <input type="text" name="nama[]" value="<?=$key->nama?>" class="form-control typehead input-nama input-cari-pegawai-all required" autocomplete="off">
                                                    <div class="text-danger"></div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label for="" class="control-label">Jabatan</label>
                                                    <input type="hidden" name="id_spt_detail[]" value="<?=$key->id_spt_detail?>">
                                                    <input type="text" name="jabatan[]" value="<?=$key->jabatan?>" class="form-control input-jabatan required" autocomplete="off">
                                                    <input type="hidden" name="nip[]" class="form-control input-nip" value="<?=$key->nip?>">
                                                    <div class="text-danger"></div>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label for="" class="control-label">Pangkat</label>   
                                                    <input type="text" name="pangkat[]" class="form-control input-pangkat" value="<?=$key->pangkat?>">
                                                    <div class="text-danger"></div>
                                                </div>
                                                <div class="form-group col-md-1 col-sm-12 p-pt-20">
                                                    <?php $count = count($detail); if($no != $count) : ?>
                                                    <label for="" class="control-label text-white">-</label>
                                                    <button type="button" class="form-control btn btn-youtube btn-hapus-petugas-kegiatan" data-id="<?=$key->id_spt_detail?>"><i class="ion-close-circled"></i> hapus</button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php $no++; } ?>
                                        </div>
                                        <div class="col-12 list-petugas-hapus"><hr></div>
                                        <div class="col-12 text-right">
                                        <button type="button" class="form-control col-3 btn btn-outline-success btn-tambah-tahap"><i class="ion-plus-circled"></i> Tahap</button>
                                        </div>
                                        <div class="col-12 list-tahap">
                                            <?php $no2=1; foreach ($tahap as $thp) { ?>
                                            <div class="row tahap">
                                                <div class="form-group col-md-5 col-sm-12">
                                                    <label for="" class="control-label">Tahap 1</label>
                                                    <input type="hidden" name="id_spt_diklat_detail[]" value="<?=$thp->id_spt_diklat_detail?>">
                                                    <input type="text" name="tahap[]" value="<?=$thp->waktu?>" class="form-control input-tahap" autocomplete="off">
                                                    <div class="text-danger"></div>
                                                </div>
                                                <div class="form-group col-md-5 col-sm-12">
                                                    <label for="" class="control-label">Tempat</label>
                                                    <input type="text" name="tempat[]" value="<?=$thp->tempat?>" class="form-control input-tempat" autocomplete="off">
                                                    <div class="text-danger"></div>
                                                </div>
                                                <div class="form-group col-md-1 col-sm-12 p-pt-20">
                                                    <?php $count = count($tahap); if($no2 != $count)  { ?>
                                                    <label for="" class="control-label text-white">-</label>
                                                    <button type="button" class="form-control btn btn-youtube btn-hapus-tahap" data-id="<?=$thp->id_spt_diklat_detail?>"><i class="ion-close-circled"></i> hapus</button>
                                                    <?php $no2++; } ?>
                                                </div>
                                            </div>
                                            <?php  } ?>
                                        </div>
                                        <div class="col-12 list-tahap-hapus"><hr></div>
                                        <div class="form-group col-6">
                                            <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                                            <div class="input-group">
                                                <input type="text" name="tgl" value="<?=$spt->tgl?>" class="form-control input-tgl datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="text-danger"></div>
                                        </div>
                                        <div class="form-group col-6" style="margin-bottom:60px">
                                            <label for="" class="control-label">Mengetahui</label>
                                            <div class="input-group">
                                                <input type="text" value="<?=$spt->nama?>" class="form-control typehead input-cari-ttd" placeholder="Mengetahui">
                                                <input type="hidden" value="<?=$spt->ttd?>" name="ttd" class="form-control typehead input-ttd" placeholder="Mengetahui">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="zmdi zmdi-account-o"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <a href="<?=base_url('spt')?>" class="btn btn-secondary mr-2">Cancel</a>                                   
                                            <button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                                                <span class="btn-label"><i class="fa fa-save"></i> </span>Update SPT Diklat
                                            </button>
                                        </div>
                                    </div>                             
                                </form>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>
        </div> <!-- container -->

    </div> <!-- content -->
</div>