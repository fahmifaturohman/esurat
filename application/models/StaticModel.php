<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StaticModel extends CI_Model
{
    public function dipa() {
        $arr = [
            "Pengadilan Tinggi Agama Bandar Lampung",
            "Penadilan Agama Tanjung Karang", "Pengadilan Agama Metro",
            "Pengadilan Agama Kalianda", "Pengadilan Agama Gunung Sugih",
            "Pengadilan Agama Tanggamus", "Pengadilan Agama Krui",
            "Pengadilan Agama Kotabumi", "Pengadilan Agama Tulang Bawang",
            "Pengadilan Agama Blambangan Umpu", "Pengadilan Agama Gedong Tataan",
            "Pengadilan Agama Sukadana", "Pengadilan Agama Pringsewu",
            "Pengadilan Agama Tulang Bawang Tengah", "Pengadilan Agama Mesuji",
            "Mahkamah Agung RI", "Badan Urusan Administrasi Mahkamah Agung RI","Badilag", "Pusdiklat", "Lainnya"
        ];
        return $arr;
    }
}
