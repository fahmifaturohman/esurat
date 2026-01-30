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
                            <li class="breadcrumb-item active"><?=$title;?></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0">Form Edit SPT Kegiatan</h4>
                        <p class="text-muted font-13 m-b-10">
                           Sialahkan ada lakukan perubahan data SPT Kegiatan
                        </p>
                        <div class="row">
                            <div class="col-12">
                                <form id ="form-edit" class="form-kegiatan" method="POST">
                                <div class="row">
                                    <input type="hidden" name="spt_tipe" class="input-spt-tipe" value="spt kegiatan">
                                    <div class="form-group col-4">
                                        <label for="input-cari-pegawai" class="control-label">Pejabat yang memberi tugas :</label>                        
                                        <input type="text" name="penugas" value="<?=$spt->penugas?>" class="form-control typeahead input-penugas input-cari-jabatan required" placeholder="Ditugaskan oleh" autocomplete="off">
                                        <input type="hidden" name="id_spt" value="<?=$spt->id_spt?>">
                                        <div class="text-danger"></div>
                                    </div>               
                                    <div class="form-group col-lg-8 col-sm-12">
                                        <label for="input-cari-pegawai" class="control-label">Hari/Tanggal Kegiatan</label>
                                        <input type="text" name="tgl_kegiatan" value="<?=$data['data']->tgl_kegiatan?>" class="form-control input-daterange-datepicker input-tanggal-kegiatan required" placeholder="Waktu Kegiatan" autocomplete="off">
                                        <input type="hidden" name="tgl_kegiatan_old" value="<?=$data['data']->tgl_kegiatan?>">
                                        <input type="hidden" value="<?=$data['data']->tgl_kegiatan?>" class="hide-input-tanggal-kegiatan">
                                        <input type="hidden" name="id_spt_kegiatan" value="<?=$data['data']->id_spt_kegiatan?>">
                                        <div class="text-danger"></div>
                                    </div>          
                                    <div class="form-group col-lg-12 col-sm-12">
                                        <label for="" class="control-label">Tempat</label>
                                        <input type="text" name="tempat" value="<?=$data['data']->tempat_kegiatan?>" class="form-control typehead input-tempat input-cari-tempat required" placeholder="Tempat Kegiatan" autocomplete="off">
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="" class="control-label">Alamat Tempat Kegiatan (optional)</label>
                                        <textarea name="alamat" class="form-control input-alamat" autocomplete="on" cols="10" rows="3"><?=$data['data']->alamat_kegiatan?></textarea>
                                        <div class="text-danger"></div>
                                    </div>               
                                    <div class="form-group col-12">
                                        <label for="" class="control-label">Kegiatan</label>
                                        <textarea name="kegiatan" class="form-control input-kegiatan required" autocomplete="off" cols="10" rows="3"><?=$data['data']->kegiatan?></textarea>
                                        <div class="text-danger"></div>
                                    </div>  
                                    <div class="form-group col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="radio" name="dipa_status" class="control-label radio-dipa dipa" value="1" <?=($data['data']->dipa_status == "1") ? ' checked':''?>> 
                                                <label for="" class="control-label span-dipa">DIPA</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="radio" name="dipa_status" class="control-label radio-dipa non-dipa" value="0" <?=($data['data']->dipa_status == "0") ? ' checked':''?>> 
                                                <label for="" class="control-label span-dipa">NON DIPA</label>
                                            </div>
                                        </div>
                                    </div>                  
                                    <div class="form-group col-lg-6 col-sm-12 list-dipa <?=($data['data']->dipa_status == "0") ? 'd-none':''?>">
                                        <label for="" class="control-label">Dipa (Satuan Kerja)</label>
                                        <div class="row col-12">
                                            <select class="select2 form-control input-dipa" name="dipa">
                                                <?php foreach ($data['dipa'] as $key ) { 
                                                    $selected = ($key == $data['data']->dipa) ? "selected":"";   
                                                ?>
                                                ?>
                                                <option value="<?=$key?>" <?=$selected?>><?=$key?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                <?php } ?>
                                            </select> 
                                        </div>                 
                                        <div class="text-danger"></div>
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12 list-dipa  <?=($data['data']->dipa_status == "0") ? 'd-none':''?>">
                                        <label for="" class="control-label">Tahun Anggaran</label>
                                        <div class="input-group">
                                            <input type="text" name="tahun" value="<?=$data['data']->tahun_anggaran?>" class="form-control input-tahun datepicker-year" placeholder="Tahun" autocomplete="off" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="col-12"><hr></div>
                                    <div class="col-12 text-right">
                                    <button type="button" class="form-control col-md-2 col-sm-12 btn btn-outline-success btn-tambah-petugas-kegiatan"><i class="ion-plus-circled"></i> Tambah Petugas</button>
                                    </div>
                                    <div class="col-12 list-petugas">
                                        <?php $no = 1; foreach ($detail as $key) { ?>                                        
                                        <div class="row petugas">
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="" class="control-label">Petugas</label>
                                                <input type="text" name="nama[]" value="<?=$key->nama?>" class="form-control typehead input-nama input-cari-pegawai required" autocomplete="off">
                                                <div class="text-danger"></div>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="" class="control-label">Jabatan</label>
                                                <input type="hidden"name="id_spt_detail[]" value="<?=$key->id_spt_detail?>">
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
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                                        <div class="input-group">
                                            <input type="text" name="tgl" value="<?=$spt->tgl?>" class="form-control input-tgl datepicker-autoclose required" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12" style="margin-bottom:60px">
                                        <label for="" class="control-label">Mengetahui</label>
                                        <div class="input-group">
                                            <input type="text" value="<?=$spt->nama?>" class="form-control typehead input-cari-ttd required" placeholder="Mengetahui">
                                            <input type="hidden" name="ttd" value="<?=$spt->ttd?>" class="form-control typehead input-ttd" placeholder="Mengetahui">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="zmdi zmdi-account-o"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                    <a href="<?=base_url('spt')?>" class="btn btn-secondary mr-2">Cancel</a>                                   
                                        <button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                                            <span class="btn-label"><i class="fa fa-save"></i> </span>Update SPT Kegiatan
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