<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <a href="<?=base_url($page)?>/add" class="btn waves-effect waves-light btn-md btn-purple">
                            <i class="ion-plus-circled m-r-5"></i> <span>Tambah Pimpinan</span> 
                            </a>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>pimpinan"><?=$title;?></a></li>
                            <li class="breadcrumb-item active">Daftar Pimpinan</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable" class="table dt-responsive table-striped table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>Jabatan</th>
                                <th>Nama</th>
                                <th>Telp</th>
                                <th>Catatan</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($data as $key ) { ?>
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="<?=base_url("pimpinan/edit/")?><?=$key->id_struktur?>" type="button" class="btn waves-effect waves-light btn-sm btn-primary"><i class="ion-edit"></i></a>
                                            <a href="#" type="button" class="btn waves-effect waves-light btn-sm btn-secondary btn-delete" data-toggle="modal" data-id="<?=$key->id_struktur?>" data-isi ="<?=$key->bagian?>"><i class="ion-trash-a"></i></a>
                                        </div>
                                    </td>
                                    <td><?=$no++;?></td>
                                    <td><?=$key->bagian?></td>
                                    <td><?php 
                                        if($key->pegawai != NULL) {
                                            echo '<a type="button" class="btn-pegawai" data-toggle="modal" data-id ="'.$key->id_struktur.'" data-isi ="'.$key->bagian.'">'.$key->nama.'</a>';
                                        }
                                        else {
                                            echo '<a type="button" class="btn waves-effect waves-light btn-sm btn-danger btn-pegawai" data-toggle="modal" data-id ="'.$key->id_struktur.'" data-isi ="'.$key->bagian.'">Pilih Pejabat</a>';
                                        }
                                     ?>       
                                    </td>
                                    <td><?=$key->no_telepon?></td>
                                    <td><?php 
                                        if($key->catatan == NULL) {
                                            echo '<a type="button" class="btn waves-effect waves-light btn-sm btn-secondary btn-note" data-toggle="modal" data-id ="'.$key->id_struktur.'" data-isi ="'.$key->bagian.'">catatan</a>';
                                        }
                                        else {
                                            echo '<a type="button" class="btn waves-effect waves-light btn-sm btn-warning btn-note" data-toggle="modal" data-id ="'.$key->id_struktur.'" data-isi ="'.$key->bagian.'">'.$key->catatan.'</a>';
                                        }
                                     ?>       
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->


        </div> <!-- container -->

    </div> <!-- content -->
</div>


<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel-2">Hapus Data</h4>
			</div>
			<div class="modal-body">
				<p><h5>Apakah anda yakin ingin menghapus asal tujuan surat  <span class="text-modal"><span>?</h5></p>
				<input name="id" class="id" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-delete-yes">Hapus</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel-2"></h4>
			</div>
            <form id="form-pegawai">
			<div class="modal-body">
                <div class="form-group">
                    <label for="input-cari-pegawai">Pegawai</label>
                    <input type="hidden" name="id" id="id"> 
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
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Update</button>
			</div>
            </form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel-2"></h4>
			</div>
            <form id="form-note">
			<div class="modal-body">
				<input name="id" class="id" type="hidden">
                <div class="form-group">
                    <label for="input-note">Catatan</label>
                    <textarea name="note" id="input-note-modal" cols="30" rows="3" class="form-control"></textarea>
                    <span class="text-danger"></span>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
			</div>
            </form>
		</div>
	</div>
</div>