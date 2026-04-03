<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="<?=base_url()?>" class="logo">
            <img src="<?=dirImage("app-logo-new.png")?>" alt="pta bandar lampung" width="42">
            <span style="color:#113B63">esurat</span></a>           
    </div>

    <nav class="navbar-custom" style="background: linear-gradient(to right, #2ebf91, #8360c3); !important">

        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                    <i class="zmdi zmdi-calendar-note noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5><small>Pilih Tahun</small></h5>
                    </div>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-success"><i class="zmdi zmdi-calendar"></i></div>
                        <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1min ago</small></p>
                    </a>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                        View All
                    </a>
                </div>
            </li>
            
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                    <i class="zmdi zmdi-notifications-none noti-icon"></i>
                    <span class="noti-icon-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5><small><span class="badge badge-danger">7</span>Notification</small></h5>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                        <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1min ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                        <p class="notify-details">New user registered.<small class="text-muted">1min ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                        <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1min ago</small></p>
                    </a>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                        View All
                    </a>
                </div>
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                    <i class="zmdi zmdi-email noti-icon"></i>
                    <span class="noti-icon-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg" aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title bg-success">
                        <h5><small><span class="badge badge-danger">7</span>Messages</small></h5>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-faded">
                            <img src="<?=dirTemplate()?>images/users/avatar-2.jpg" alt="img" class="rounded-circle img-fluid">
                        </div>
                        <p class="notify-details">
                            <b>Robert Taylor</b>
                            <span>New tasks needs to be done</span>
                            <small class="text-muted">1min ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-faded">
                            <img src="<?=dirTemplate()?>images/users/avatar-3.jpg" alt="img" class="rounded-circle img-fluid">
                        </div>
                        <p class="notify-details">
                            <b>Carlos Crouch</b>
                            <span>New tasks needs to be done</span>
                            <small class="text-muted">1min ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-faded">
                            <img src="<?=dirTemplate()?>images/users/avatar-4.jpg" alt="img" class="rounded-circle img-fluid">
                        </div>
                        <p class="notify-details">
                            <b>Robert Taylor</b>
                            <span>New tasks needs to be done</span>
                            <small class="text-muted">1min ago</small>
                        </p>
                    </a>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                        View All
                    </a>

                </div>
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                    <?php $gambar_account = ($this->session->userdata(MY_SESSION_DATA)->gambar == NULL) ? dirTemplate().'images/users/avatar-1.jpg':LINK_GAMBAR.$this->session->userdata(MY_SESSION_DATA)->gambar?>
                    <img src="<?=$gambar_account?>" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow"><small><?=$this->session->userdata(MY_SESSION_DATA)->username;?></small> </h5>
                    </div>

                    <a href="javascript:void(0);" class="dropdown-item notify-item" id="button-pilih-tahun">
                        <i class="zmdi zmdi-calendar"></i> <span>Pilih Tahun</span>
                    </a>

                    <script type="text/javascript">
                         $(document).ready(function(){
                           $('#button-pilih-tahun').on('click', function() {
                                $('#modal-pilih-tahun').modal('show')
                            })
                            $('#form-thang').on('submit', function(e) {
                                e.preventDefault()
                                let thang = $('#input-thang').val()
                                $.ajax({
                                    url: "<?=base_url()?>home/set_thang",
                                    method: "POST",
                                    data: {thang: thang},
                                    success: function() {
                                        location.reload()
                                    }
                                })
                            })
                            if (typeof $.cookie("<?php echo MY_THANG; ?>") === 'undefined') $('#modal-pilih-tahun').modal('show')
                        })
                    </script>


                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-lock-open"></i> <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="<?=base_url('login/out')?>" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-power"></i> <span>Logout</span>
                    </a>

                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="zmdi zmdi-menu"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End -->

<div class="modal fade" id="modal-pilih-tahun" tabindex="-1" role="dialog" data-backdrop="static" aria-label="modal1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="myModalLabel-2">Pilih Tahun</h6>
            </div>
            <form id="form-thang">
            <div class="modal-body">

                <div class="form-group">
                    <label for="input-cari-pegawai">Pilih Tahun</label>
                    <select class="form-control" id="input-thang" name="thang>
                        <?php
                            $thang_selected = my_get_cookie(MY_THANG);
                            $thangs = date("Y")+1;for ($i = $thangs; $i >= $thangs-5; $i--) { 
                        ?>
                        <option value="<?=$i?>" <?= ($i == $thang_selected) ? 'selected':''; ?>>Tampilkan Data Tahun <?=$i;?></option>
                        <?php } ?>
                       <option value="all">Tampilkan Semua Data</option>
                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>