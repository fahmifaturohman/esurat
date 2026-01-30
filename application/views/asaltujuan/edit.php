<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">
                            <a href="<?=base_url('asaltujuan')?>" class="waves-effect waves-light btn-sm">
                            <i class="ion-chevron-left m-r-5"></i> <span>Kembali</span> 
                            </a>
                        </h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?=base_url('asaltujuan')?>"><?=$title;?></a></li>
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

                        <h4 class="header-title m-t-0 m-b-30">Form Update</h4>

                        <div class="row">
                            <div class="col-xl-12">
                                <form id = "form-update">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?=$data->id_asal_tujuan?>">
                                        <label for="input-asal-tujuan">Asal Tujuan Surat</label>
                                        <textarea name="asal_tujuan" id="input-asal-tujuan" cols="30" rows="5" class="form-control"><?=$data->asal_tujuan?></textarea>
                                        <span class="text-danger"></span>
                                    </div>
                                    <a href="<?=base_url('asaltujuan')?>" class="btn btn-secondary">Cancel</a>                                   
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