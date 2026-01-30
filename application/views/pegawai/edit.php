<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url('pimpinan')?>"><?=$title;?></a></li>
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

                        <h4 class="header-title m-t-0 m-b-30">Form Input</h4>

                        <div class="row">
                            <div class="col-xl-12">
                                <form id = "form-update">
                                    <div class="form-group">
                                        <label for="input-bagaian" class="control-label">Jabatan</label>
                                        <input type="hidden" name="id" value="<?=$data->id_struktur?>">
                                        <input type="text" name="bagian" value="<?=$data->bagian?>" class="form-control" id="input-bagian-edit" placeholder="" autocomplete="off">
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-parent" class="control-label">Atasan</label>
                                        <select name="parent" id="input-parent" class="form-control">
                                            
                                           <?php 
                                            $select = ($data->parent == Null) ? "selected":"";
                                            echo '<option value="0" '.$selected.'>Tidak ada atasan</option>';
                                            foreach ($parent as $key) { 
                                                $selected = ($data->parent == $key->id_struktur) ? "selected":"";     
                                            ?>
                                            <option value="<?=$key->id_struktur?>" <?=$selected?>><?=$key->bagian?></option>
                                            <?php }?>
                                        </select>
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-cari-pegawai" class="control-label">Pilih Pegawai</label>
                                        <input type="text" name="id_pegawai" value="<?=$data->nama_pegawai?>" class="form-control typeahead input-id-pegawai" id="input-cari-pegawai" placeholder="cari pegawai" autocomplete="off">
                                        <div class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-note">Catatan</label>
                                        <textarea name="note" id="input-note" cols="30" rows="5" class="form-control"><?=$data->catatan?></textarea>
                                        <span class="text-danger"></span>
                                    </div>
                                    <a href="<?=base_url('pimpinan')?>" class="btn btn-secondary">Cancel</a>                                   
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>
        </div> <!-- container -->

    </div> <!-- content -->
</div>