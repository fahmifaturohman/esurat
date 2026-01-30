

           


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <?php if($page != "login") { ?>
            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <div class="nicescroll">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a href="#home-2"  class="nav-link active" data-toggle="tab" aria-expanded="false">
                                Activity
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#messages-2" class="nav-link" data-toggle="tab" aria-expanded="true">
                                Settings
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="home-2">
                            <div class="timeline-2">
                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">5 minutes ago</small>
                                        <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">30 minutes ago</small>
                                        <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">59 minutes ago</small>
                                        <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">1 hour ago</small>
                                        <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">3 hours ago</small>
                                        <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">5 hours ago</small>
                                        <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="messages-2">

                            <div class="row m-t-10">
                                <div class="col-8">
                                    <h5 class="m-0">Notifications</h5>
                                    <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-10">
                                <div class="col-8">
                                    <h5 class="m-0">API Access</h5>
                                    <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-10">
                                <div class="col-8">
                                    <h5 class="m-0">Auto Updates</h5>
                                    <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-10">
                                <div class="col-8">
                                    <h5 class="m-0">Online Status</h5>
                                    <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end nicescroll -->
            </div>
            <!-- /Right-bar -->            
            <footer class="footer">
            <?=date("Y")?> © E-Surat | Pengadilan Tinggi Agama Bandar Lampung.
            </footer>
            <?php } ?>

        </div>
        <!-- END wrapper -->


        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <!-- <script src="<?=dirTemplate()?>js/jquery.min.js"></script> -->
        <script src="<?=dirTemplate()?>js/bootstrap.bundle.min.js"></script>
        <script src="<?=dirTemplate()?>js/detect.js"></script>
        <script src="<?=dirTemplate()?>js/fastclick.js"></script>
        <script src="<?=dirTemplate()?>js/jquery.blockUI.js"></script>
        <script src="<?=dirTemplate()?>js/waves.js"></script>
        <script src="<?=dirTemplate()?>js/jquery.nicescroll.js"></script>
        <script src="<?=dirTemplate()?>js/jquery.scrollTo.min.js"></script>
        <script src="<?=dirTemplate()?>js/jquery.slimscroll.js"></script>
        <script src="<?=dirPlugin()?>switchery/switchery.min.js"></script>

        <script src="<?=dirPlugin()?>bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
        <script src="<?=dirPlugin()?>multiselect/js/jquery.multi-select.js"></script>
        <script src="<?=dirPlugin()?>jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="<?=dirPlugin()?>select2/js/select2.full.min.js"></script>
        <script src="<?=dirPlugin()?>bootstrap-maxlength/bootstrap-maxlength.js"></script>

        <!-- Autocomplete -->
        <!-- <script src="<?=dirPlugin()?>autocomplete/jquery.mockjax.js"></script> -->
        <script src="<?=dirPlugin()?>autocomplete/jquery.autocomplete.min.js"></script>
        <script src="<?=dirPlugin()?>autocomplete/countries.js"></script>
        <script src="<?=dirTemplate()?>pages/jquery.autocomplete.init.js"></script>
        <script src="<?=dirTemplate()?>pages/jquery.formadvanced.init.js"></script>

        <!-- Required datatable js -->
        <script src="<?=dirPlugin()?>datatables/jquery.dataTables.min.js"></script>
        <script src="<?=dirPlugin()?>datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?=dirPlugin()?>datatables/dataTables.buttons.min.js"></script>
        <script src="<?=dirPlugin()?>datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?=dirPlugin()?>datatables/jszip.min.js"></script>
        <script src="<?=dirPlugin()?>datatables/pdfmake.min.js"></script>
        <script src="<?=dirPlugin()?>datatables/vfs_fonts.js"></script>
        <script src="<?=dirPlugin()?>datatables/buttons.html5.min.js"></script>
        <script src="<?=dirPlugin()?>datatables/buttons.print.min.js"></script>
        

        <!-- Key Tables -->
        <script src="<?=dirPlugin()?>datatables/dataTables.keyTable.min.js"></script>

        <!-- Responsive examples -->
        <script src="<?=dirPlugin()?>datatables/dataTables.responsive.min.js"></script>
        <script src="<?=dirPlugin()?>datatables/responsive.bootstrap4.min.js"></script>

        <!-- Selection table -->
        <script src="<?=dirPlugin()?>datatables/dataTables.select.min.js"></script>



        <!--Morris Chart-->
		<!-- <script src="<?=dirPlugin()?>morris/morris.min.js"></script> -->
		<script src="<?=dirPlugin()?>raphael/raphael.min.js"></script>

        <!-- Counter Up  -->
        <script src="<?=dirPlugin()?>waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?=dirPlugin()?>counterup/jquery.counterup.js"></script>

        <!-- Page specific js -->
        <!-- <script src="<?=dirTemplate()?>pages/jquery.dashboard.js"></script> -->

        <!-- App js -->
        <script src="<?=dirTemplate()?>js/jquery.core.js"></script>
        <script src="<?=dirTemplate()?>js/jquery.app.js"></script>
        
        <!--loading-->
	    <script src="<?=dirPlugin()?>loading/js/jquery.loadingModal.js"></script>
        <!-- Toastr -->
        <script src="<?=dirPlugin()?>toastr/toastr.min.js"></script>

        <!-- Modal-Effect -->
        <script src="<?=dirPlugin()?>custombox/js/custombox.min.js"></script>
        <script src="<?=dirPlugin()?>custombox/js/custombox.legacy.min.js"></script>

        <!-- date picker -->
        <script src="<?=dirPlugin()?>moment/moment.js"></script>
        <script src="<?=dirPlugin()?>timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?=dirPlugin()?>clockpicker/bootstrap-clockpicker.js"></script>
        <script src="<?=dirPlugin()?>mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="<?=dirPlugin()?>bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="<?=dirPlugin()?>bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?=jsView()?>jquery.form-pickers.init.js"></script>
        
        <script src="<?=jsView()?>core-function.js"></script>
        <script src="<?=jsView()?>core-validation.js"></script>
        <?php 
            if(!empty($js)) {
                foreach ($js as $key) {
                    echo '<script src="'.jsView().$key.'.js"></script>';
                }
            }
        ?>

        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });
                $('#key-table').DataTable({
                    keys: true
                });
                $('#responsive-datatable').DataTable();
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });
                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

                $('.datepicker-autoclose').datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight:'TRUE',
                    autoclose: true,
                })

                $('.datepicker-year').datepicker({
                    format: "yyyy",
                    weekStart: 1,
                    orientation: "bottom",
                    language: "{{ app.request.locale }}",
                    keyboardNavigation: false,
                    viewMode: "years",
                    minViewMode: "years",
                    autoclose: true,
                });

            } );

        </script>
        
    </body>
</html>