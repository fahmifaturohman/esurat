<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>suratmasuk"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Disposisi Surat Masuk</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h1 class="text-danger"><i class="fa fa-file-pdf-o"></i></h1> 
                                    </div> 
                                    <div class="col-md-9">                                                    
                                        <span><b><a href="<?=dirUpload()?>masuk/<?=$data->file_surat?>" target="_blank" download="<?=$data->file_surat?>"><?=$data->no_surat?></a></b></span><br>  
                                        <span class="row">
                                            <span class="col-md-12">
                                                <span class="row">
                                                <span class="col-md-12"><?=$data->perihal?></span>
                                                </span>
                                            </span>
                                            <span class="col-md-12">
                                                <span class="row">
                                                <span class="col-md-12"><b>Asal : <?=$data->asal_tujuan?></b></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <span>Diterima tanggal <?=date("d M Y", strtotime($data->tanggal_terima));?></span><br>
                                <span class="badge badge-pill badge-primary"><?=$data->sifat_surat?></span><br>                                             
                                <span><b>Tujuan : <?=$data->bagian?></b></span>                                       
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <?php if($data->status == 0) { ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Disposisikan Surat</b><br>
                                        <span class="badge badge-pill badge-danger">
                                            <i class="fa fa-close"></i>    
                                            Surat belum didisposisikan
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Distribusikan Surat</b><br>
                                        <span class="badge badge-pill badge-danger">
                                            <i class="fa fa-close"></i>    
                                            Surat belum didistribusikan
                                        </span>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Disposisikan Surat</b><br>
                                        <span class="badge badge-pill badge-success">
                                            <i class="fa fa-check"></i>    
                                            Surat sudah didisposisikan
                                        </span>
                                    </div>                                                
                                    <div class="col-md-6">
                                        <b>Distribusikan Surat</b><br>
                                        <?php if($data->distribusi == 0) { ?>
                                        <span class="badge badge-pill badge-danger">
                                            <i class="fa fa-close"></i>    
                                            Surat belum didistribusikan
                                        </span>
                                        <?php } else {  ?>
                                        <span class="badge badge-pill badge-success">
                                            <i class="fa fa-check"></i>    
                                            Surat sudah didistribusikan
                                        </span>
                                        <?php } ?>
                                    </div>
                                </div>                                            
                                <?php } ?>
                            </div>
                            <div class="col-md-2 col-sm-12 btn-xs-12 text-right">
                                <br>
                                <?php if($lastProcess) { if($lastProcess->catatan =="disposisi") { ?>
                                <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light btn-sm-12 btn-xs-12 btn-disposisi-awal" data-toggle="modal" data-id="<?=$data->id?>">Disposisikan <i class="ion-paper-airplane"></i></button>
                                <?php } else {  ?>
                                <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light btn-sm-12 btn-xs-12 btn-distribusi" data-toggle="modal" data-id="<?=$data->id?>">Distribusikan <i class="ion-android-send"></i></button>
                                <?php } } else { 
                                    if($data->distribusi == 0) {
                                    $lastDisposisi = reset($disposisi);
                                    echo '<button type="button" class="btn btn-success btn-rounded waves-effect waves-light btn-sm-12 btn-xs-12 btn-distribusi-pegawai" data-toggle="modal" data-id="'.$lastDisposisi->id_disposisi_masuk.'" data-isi="'.$data->id.'">Distribusikan <i class="ion-paper-airplane"></i></button>';
                                    }
                                }?>    
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if($data->distribusi != 0) { ?>
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="row">
                                    <div class="col-md-1 col-sm-2">
                                        <h1 class="text-success"><i class="fa fa-check-circle"></i></h1> 
                                    </div> 
                                    <div class="col-md-11 col-sm-10">                                                    
                                        <span><b><?=strtimedate($distribusi->tgl_distribusi)?></b><br>  
                                        <span class="row">
                                            <span class="col-md-12">
                                                <span class="row">
                                                <span class="col-md-12">Surat telah didistribusikan oleh <?=$distribusi->distribusi_oleh?></span>
                                                <span class="col-md-12">Kepada <?=$distribusi->nama_pegawai.' <b>('.$distribusi->jabatan_pegawai.')</b>'?></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="row">
                                    <span class="col-md-12 text-center">
                                        <br>
                                        <button type="button" class="btn btn-outline-success btn-rounded waves-effect waves-light btn-notifikasi" data-toggle="modal" data-id="<?=$distribusi->telp_pegawai;?>"><i class="fa fa-whatsapp"></i> Kirim Notifikasi</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="col-12">
                    <div class="card-box">
                        <div class="table-responsive">
                        <table class="table dt-responsive table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">                           
                            <thead>
                                <tr><b>Riwayat Disposisi</b></tr>
                                <tr>
                                    <th></th>
                                    <th>Dari</th>                                    
                                    <th></th>
                                    <th>Ke</th>
                                    <th>Nama</th>
                                    <th>Telp</th>
                                    <th>Catatan</th>
                                    <th>Kirim Notif</th>
                                </tr>
                            </thead>                           
                            <tbody>
                                <?php foreach ($disposisi as $key) { ?>                                
                                <tr>
                                    <td><i class="fa fa-clock-o"></i> <?=date("d M Y H:i", strtotime($key->tgl))?></td>
                                    <td><?=$key->dari?></td>
                                    <td><?php 
                                        if($key->status == "terima") {
                                            echo '<span class="badge badge-pill badge-secondary">
                                                diterima
                                            </span>';
                                        }
                                        else if($key->status == "dilihat") {
                                            echo '<span class="badge badge-pill badge-primary">
                                                <i class="fa fa-check"></i>    
                                                dilihat
                                            </span>';
                                        }
                                        else if($key->status == "setuju") {
                                            echo '<span class="badge badge-pill badge-success">
                                                <i class="fa fa-check"></i>    
                                                setuju
                                            </span>';
                                        }
                                        else if($key->status == "tolak") {
                                            echo '<span class="badge badge-pill badge-danger">
                                                <i class="fa fa-close"></i>    
                                                tolak
                                            </span>';
                                        }
                                        else if($key->status == "disposisikan") {
                                            echo '<span class="badge badge-pill badge-success">
                                                <i class="fa fa-check"></i>    
                                                disposisikan
                                            </span>';
                                        }
                                        else if($key->status == "distribusikan") {
                                            echo '<span class="badge badge-pill badge-primary">
                                                <i class="fa fa-check"></i>    
                                                distribusikan
                                            </span>';
                                        }
                                        else {
                                            echo '<span class="badge badge-pill badge-success">
                                                <i class="fa fa-check"></i>    
                                               Selesai
                                            </span>';
                                        } ?>
                                    </td>
                                    <td><?=$key->bagian?></td>
                                    <td><?=$key->nama?></td>
                                    <td><?=$key->telp?></td>
                                    <td><?=$key->catatan?></td>                                    
                                    <td>
                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                        <i class="fa fa-whatsapp"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>                
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
</div>



<div class="modal fade bs-example-modal-lg" id="modal-dispoisis-awal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Disposisi Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-submit-disposisi-awal">
            <div class="modal-body">
                <h5>Catatan : </h5>
                <p>Untuk disposisi surat masuk pertama kali, silahkan anda pilih disposisi ke bagian Kesekretariatan atau bagian Kepaniteraan.
                Ketika anda memilih kesekretariatan maka akan otomatis akan didispoisisikan ke Kasubbag TURT, dan ketika anda memilih Kepaniteraan maka
                akan otomatis di disposisikan ke Panitera
                </p>
                <hr>
                <div class="form-group">
                    <label for="">Silahkan Pilih</label>
                    <input type="hidden" name="id" class="id">
                    <select name="id_disposisi_level" id="id_disposisi_bagian" class="form-control id-disposisi-bagian">
                        <option value="">-</option>
                        <?php foreach ($level as $key ) { ?>
                            <option value="<?=$key->id_disposisi_level?>"><?=$key->pimpinan?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Catatan</label>
                    <textarea name="catatan" cols="30" rows="3" class="form-control"></textarea>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">disposisi</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal-distribusi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Distribusi Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-submit-distribusi">
            <div class="modal-body">                
                <div class="form-group">
                    <label for="">Dsitribusikan ke</label>
                    <input type="hidden" name="id" class="id">
                    <select name="id_disposisi_level" id="id_disposisi_bagian" class="form-control id-disposisi-bagian">
                        <option value="">-</option>
                        <?php foreach ($level as $key ) { ?>
                            <option value="<?=$key->id_disposisi_level?>"><?=$key->pimpinan?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Catatan</label>
                    <textarea name="catatan" cols="30" rows="3" class="form-control"></textarea>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Distribusi</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-distribusi-pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Distribusi Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-distribusi-pegawai">
			<div class="modal-body">
                <div class="form-group">
                    <label for="input-cari-pegawai">Distribusikan ke (Nama Pegawai)</label>
                    <input type="hidden" name="id" id="id"> 
                    <input type="hidden" name="id_surat_masuk" id="id_surat_masuk"> 
                    <input type="text" name="id_pegawai" class="form-control typeahead input-id-pegawai" id="input-cari-pegawai" placeholder="cari pegawai" autocomplete="off">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="input-note-modal">Catatan</label>
                    <textarea name="note" id="input-note" cols="30" rows="3" class="form-control"></textarea>
                    <span class="text-danger"></span>
                </div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Distribusikan</button>
			</div>
            </form>
		</div>
	</div>
</div>
