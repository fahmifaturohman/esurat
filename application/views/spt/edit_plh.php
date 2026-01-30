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

                        <h4 class="header-title m-t-0">Form Edit SPT PLH</h4>
                        <p class="text-muted font-13 m-b-10">
                           Sialahkan ada lakukan perubahan data SPT PLH
                        </p>
                        <div class="row">
                            <div class="col-12">
                                <form id ="form-edit" method="POST">
                                    <div class="row">
                                        <input type="hidden" name="spt_tipe" class="input-spt-tipe" value="spt plh">
                                        <div class="form-group col-md-12 col-sm-12">
                                            <label for="input-cari-pegawai" class="control-label">Pejabat Yang Memberi Tugas :</label>                        
                                                <input type="text" name="penugas" value="<?=$spt->penugas?>" class="form-control typeahead input-penugas input-cari-jabatan" placeholder="Ditugaskan oleh" autocomplete="off">
                                                <input type="hidden" name="id_spt" value="<?=$spt->id_spt?>">
                                            <div class="text-danger"></div>
                                        </div>
                                        <div class="col-12"><hr></div>
                                        <div class="col-12 list-petugas">
                                            <?php $no = 1; foreach ($detail as $key) { ?>
                                            <div class="row petugas">
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label for="" class="control-label">Pejabat Yang diberi Tugas : </label>
                                                    <input type="text" name="nama[]" value="<?=$key->nama?>" class="form-control typehead input-nama input-cari-pegawai" autocomplete="off">
                                                    <div class="text-danger"></div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <input type="hidden"name="id_spt_detail[]" value="<?=$key->id_spt_detail?>">
                                                    <label for="" class="control-label">Jabatan</label>
                                                    <input type="text" name="jabatan[]" value="<?=$key->jabatan?>" class="form-control input-jabatan required" autocomplete="off">
                                                    <input type="hidden" name="nip[]" value="<?=$key->nip?>"c lass="form-control input-nip">
                                                    <div class="text-danger"></div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label for="" class="control-label">Pangkat</label>
                                                    <input type="text" name="pangkat[]" value="<?=$key->pangkat?>" class="form-control input-pangkat required" autocomplete="off">
                                                    <div class="text-danger"></div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="input-cari-pegawai" class="control-label">Ditugaskan Sebagai :</label>
                                            <select name="plh" class="form-control input-plh"> 
                                                <?php foreach ($plh as $key) { 
                                                    $selected = ($key == $data->plh) ? "selected":"";?>
                                                    <option value="<?=$key?>" <?=$selected?>><?=$key?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="text-danger"></div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="control-label">Waktu PLH :</label>
                                            <input type="text" name="waktu" class="form-control input-waktu input-daterange-datepicker required" placeholder="Waktu Plh" autocomplete="off">
                                            <input type="hidden" name="waktu_old" class="input-waktu-old" value="<?=$data->waktu?>">
                                            <input type="hidden" name="id_spt_plh" value="<?=$data->id_spt_plh?>">
                                            <div class="text-danger"></div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="input-cari-pegawai" class="control-label">Alasan Plh</label>                            
                                            <select name="alasan" class="form-control input-alasan required">
                                                <?php foreach ($alasan as $key ) { $selected =($key == $data->alasan) ? "selected":""; ?>
                                                    <option value="<?=$key?>" <?=$selected?>><?=$key?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="input-cari-pegawai" class="control-label">Keterangan :</label>
                                            <div class="row">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>1. </td>
                                                            <td>Surat Tugas ini dibuat karena <b><span class="input-keterangan"><?=$data->plh?></span></b> Pengadilan Tinggi Agama Bandar Lampung sedang <b><span class="text-alasan"><?=$data->alasan?></span></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2. </td>
                                                            <td>Kepada Pejabat yang ditunjuk untuk dapat melaksanakan tugasnya sebagai Pelaksana Harian (Plh) <b><span class="input-keterangan"><?=$data->plh?></span></b> Pengadilan Tinggi Agama Bandar Lampung dan melaporkan tugasnya kepada <span class="input-keterangan"><?=$data->plh?></span> Pengadilan Tinggi Agama Bandar Lampung</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12"><hr></div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="" class="control-label">Ditetapkan Pada Tanggal</label>
                                            <div class="input-group">
                                                <input type="text" name="tgl" value="<?=$spt->tgl?>" class="form-control input-tgl datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="text-danger"></div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12" style="margin-bottom:60px">
                                            <label for="" class="control-label">Mengetahui</label>
                                            <div class="input-group">
                                                <input type="text" value="<?=$spt->nama?>" class="form-control typehead input-cari-ttd" placeholder="Mengetahui">
                                                <input type="hidden" name="ttd" value="<?=$spt->ttd?>" class="form-control typehead input-ttd" placeholder="Mengetahui">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="zmdi zmdi-account-o"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <a href="<?=base_url('spt')?>" class="btn btn-secondary mr-2">Cancel</a>                                   
                                            <button type="submit" class="btn btn-instagram waves-effect waves-light btn-blue">
                                                <span class="btn-label"><i class="fa fa-save"></i> </span>Upadate SPT PLH
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