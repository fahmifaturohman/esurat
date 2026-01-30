<?php 
// function api($string) {
//     return base_url();
// }

function dirTemplate() {
    return base_url()."public/bootstrap/assets/";
}

function dirPlugin() {
    return base_url()."public/bootstrap/plugins/";
}


function jsView() {
    return base_url()."public/js-view/";
}

function dirUpload() {
    return base_url()."public/upload/";
}


function templateView($page, $data) {
    $ci = get_instance();
    $ci->load->view('template/header', $data);
    $ci->load->view('template/navbar');
    $ci->load->view('template/sidebar');
    $ci->load->view($page);
    $ci->load->view('template/footer');
}

function dirImage($filename = "") { return base_url('public/upload/images/'.$filename); }
function dirMasuk($filename = "") { return base_url('public/upload/masuk/'.$filename); }
function dirKeluar($filename = "") { return base_url('public/upload/keluar/'.$filename); }



function uploadFile($filetmp, $filename, $path = "public/upload/") {
    move_uploaded_file($filetmp, $path.$filename);
}

function removeFile($filename, $path = "public/upload/") {
    unlink($path.$filename);
}