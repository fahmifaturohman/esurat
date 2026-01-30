<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">

	<!-- App Favicon -->
	<link rel="shortcut icon" href="<?=dirImage('app-logo-new-ico.ico')?>">

	<!-- App title -->
	<title>esurat | <?=$page?></title>

	<!-- Plugins css-->
	<link href="<?=dirPlugin()?>bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="<?=dirPlugin()?>multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
	<link href="<?=dirPlugin()?>select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="<?=dirPlugin()?>morris/morris.css">

	<!-- DataTables -->
	<link href="<?=dirPlugin()?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=dirPlugin()?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<!-- Responsive datatable examples -->
	<link href="<?=dirPlugin()?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<!-- Multi Item Selection examples -->
	<link href="<?=dirPlugin()?>datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />


	<!-- Switchery css -->
	<link href="<?=dirPlugin()?>switchery/switchery.min.css" rel="stylesheet" />

	<!-- Custom box css -->
	<link href="<?=dirPlugin()?>custombox/css/custombox.min.css" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link href="<?=dirTemplate()?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- App CSS -->
	<link href="<?=dirTemplate()?>css/style.css" rel="stylesheet" type="text/css" />
	
	<!--loading-->
	<link rel="stylesheet" href="<?=dirPlugin()?>loading/css/jquery.loadingModal.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?=dirPlugin()?>toastr/toastr.css">

	<!-- Modernizr js -->
	<script src="<?=dirTemplate()?>js/modernizr.min.js"></script>       

	<!-- datepicker -->
	<link href="<?=dirPlugin()?>mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="<?=dirPlugin()?>clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
	<link href="<?=dirPlugin()?>timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="<?=dirPlugin()?>bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="<?=dirPlugin()?>bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- jquery typehead -->
	<script src="<?=dirTemplate()?>js/jquery.min.js"></script>
	<script src="<?=dirPlugin()?>typehead/typeahead.js"></script>
	<link href="<?=dirTemplate()?>css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form id="form-login" method="POST">
			<img  class="img-logo" src="<?=dirImage('app-logo-new-gray.png')?>" alt="" width="200">
			<input name="username" id="input-username" type="text" placeholder="Username" autocomplete="off" required>
			<input name="password" id="input-password" type="password" placeholder="Password" autocomplete="off" required>
			<a href="#" class="forgot-password">Forgot your password ? <span class="tooltip-text">Silahkan Hubungi Admin</span></a>
			<button>Sign In</button>
		</form>
	</div>

	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>ESURAT</h1>
				<p>aplikasi yang dirancang untuk mendukung pengelolaan administrasi surat di lingkungan Pengadilan Tinggi Agama Bandar Lampung. Melalui aplikasi ini, proses pengelolaan surat masuk, surat keluar, serta permohonan izin keluar kantor pegawai dapat dilakukan secara lebih cepat, tertib, dan terdokumentasi dengan baik dalam satu sistem digital</p>
			</div>
		</div>
	</div>
</div>
	


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