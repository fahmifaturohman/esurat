<!doctype html>
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
        <link href="<?=dirTemplate()?>css/custom.css" rel="stylesheet" type="text/css" />
        
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>


    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">