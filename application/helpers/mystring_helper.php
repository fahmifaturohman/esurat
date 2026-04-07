<?php 

function rupiah($angka){
    $rupiah=number_format($angka,0,',','.');
    return $rupiah;
}

function strdateteime($date) {
    return date('d M Y H:i', strtotime($date));
}

function strtimedate($date) {
    return date('H:i d M Y', strtotime($date));
}
function strdate($date) {
    return date('d M Y', strtotime($date));
}
function strdateIndo($date) {
    $hari = date('d', strtotime($date));
    $tgl = date('m', strtotime($date));
    $tahun = date('Y', strtotime($date));
    $array = [
        "01"=> 'Januari',
        "02" => 'Februari',
        "03" => 'Maret',
        "04" => 'April',
        "05" => 'Mei',
        "06" => 'Juni',
        "07" => 'Juli',
        "08" => 'Agustus',
        "09" => 'September',
        "10" => 'Oktober',
        "11" => 'November',
        "12" => 'Desember'
    ];
    $str = (int)$hari.' '.$array[$tgl].' '.$tahun;
    return $str;
}

function selisih($date) {
    $waktustart = $date;
    $waktuend = date("Y-m-d");    
    $datetime1 = new DateTime($waktustart);//start time
    $datetime2 = new DateTime($waktuend);//end time
    $durasi = $datetime1->diff($datetime2);
    return $durasi->format('%Y tahun %m bulan %d hari');
}

function selisihJam($dari = "", $sampai = "") {
    $from = strtotime($dari);
    $to = strtotime($sampai);
    $diff = $to-$from;
    //membagi detik menjadi jam
    $jam    =floor($diff / (60 * 60));
    //membagi sisa detik setelah dikurangi $jam menjadi menit
    $menit    =$diff - $jam * (60 * 60);
    return $jam.' jam '.$menit.' menit';
}

function dayIndo($date) {
    $hari = date('D', strtotime($date));
    $array = [
        "Sun" => "Minggu", 
        "Mon" => "Senin",
        "Tue" => "Selasa",
        "Wed" => "Rabu",
        "Thu" => "Kamis",
        "Fri" => "Jum'at",
        "Sat" => "Sabtu",
    ];
    return $array[$hari];
}

function monthIndo($date) {
    $bulan = date('m', strtotime($date));
    $array = [
        "01"=> 'Januari',
        "02" => 'Februari',
        "03" => 'Maret',
        "04" => 'April',
        "05" => 'Mei',
        "06" => 'Juni',
        "07" => 'Juli',
        "08" => 'Agustus',
        "09" => 'September',
        "10" => 'Oktober',
        "11" => 'November',
        "12" => 'Desember'
    ];
    return $array[$bulan];
}

function daterangeIndo($date) {
    $exp = explode("-", $date);
    $dari =  date('Y-m-d', strtotime($exp[0]));
    $sampai =  date('Y-m-d', strtotime($exp[1]));

    if($dari == $sampai) {
        $str = dayIndo($dari).' / '.strdateIndo($dari);
    }
    else {
        $hari_dari = dayIndo($dari);
        $hari_sampai = dayIndo($sampai);
        $tgl_dari = (int) date('d', strtotime($dari));
        if(date('Y-m', strtotime($dari)) == date('Y-m', strtotime($sampai))) {
            $str = $hari_dari.' s.d '.$hari_sampai.', '.$tgl_dari.' s.d '.strdateIndo($sampai);
        }
        else {
            $str = $hari_dari.', '.strdateIndo($dari).' s.d '.$hari_sampai.', '.strdateIndo($sampai);
        }        
    }


    return $str;
}

function timerangeIndo($date) {
    $exp = explode("-", $date);
    $dari =  date('Y-m-d H:i:s', strtotime($exp[0]));
    $sampai =  date('Y-m-d H:i:s', strtotime($exp[1]));
    $str = $dari.' s.d '.$sampai;
    return $str;
}


function my_crypt($string) {
    $ci = get_instance();
    return $ci->encrypt->encode($string, MY_KEY);
}

function my_get_cookie($key) {
    $ci = get_instance();
    $val = $ci->input->cookie($key, true);
    if(!empty($val)) {
        $val = $ci->encrypt->decode($val, MY_KEY);
    }
    return $val;
}

function my_filter_year() {
    $ci = get_instance();
    $val = $ci->input->cookie(MY_THANG);
    if(!empty($val)) return $ci->encrypt->decode($val, MY_KEY);
    else return CURRENT_YEAR;
}

function my_enc($str) {
     $ci = get_instance();
     return $ci->encrypt->encode($str, MY_KEY);
}
function my_dec($str) {
     $ci = get_instance();
     return $ci->encrypt->decode($str,MY_KEY);
}