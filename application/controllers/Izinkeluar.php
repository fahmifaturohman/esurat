<?php

use phpDocumentor\Reflection\Types\Parent_;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

defined('BASEPATH') OR exit('No direct script access allowed');

class IzinKeluar extends CI_Controller
{
    private $page;
    
    public function __construct()
    {
        parent::__construct();
        $this->page = "izin-keluar";
        $this->load->model("IzinKeluarModel", "model");
        $this->load->model("PegawaiSipecutModel", "model1");
        $this->load->model("PegawaiModel", "pegawai");
        isLogin();
    }

    public function index() 
    {
        $data = [
            'page' => $this->page,
            'title' => "Izin Keluar Kantor",
            'data' => $this->model->getData(),
            'js' => [""],
        ];
        templateView("izin/keluar-kantor", $data);
    }


    public function add() {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
                $validation = $this->form_validation;
                $validation->set_rules($this->model->rules());
                if($validation->run()) {
                        $post = $this->input->post();
                        $param = [
                           'pegawai' => $post['pegawai'],
                           'dari' => $post['dari'],
                           'sampai' => $post['sampai'],
                           'tgl_mengetahui' => $post['tgl'] ,
                           'keperluan' => $post['keperluan'],
                           'kepada' => $post['kepada'],
                           'ditetapkan' => CURRENT_DITETAPKAN,
                           'ttd' => $post['ttd'],
                        ];        
                        #insert to table izin keluar
                        $result = $this->model->insertData($param);
                        if($result) {
                            if($post['pegawai'] == "asn") {
                                $param_detail = [
                                    'id_izin' => $result,
                                    'nama' => $post['nama'],
                                    'nip' => $post['nip'],
                                    'pangkat' => $post['pangkat'],
                                    'jabatan' => $post['jabatan'],
                                    'unit_kerja' => NAMA_INSTANSI,
                                    'gambar' => $post['gambar'],
                                ];
                            }
                            else {
                                $param_detail = [
                                    'id_izin' => $result,
                                    'nama' => $post['nama'],
                                    'jabatan' => $post['jabatan'],
                                    'unit_kerja' => NAMA_INSTANSI,
                                    'gambar' => $post['gambar'],
                                ];
                            }
                            #insert to izin keluar detail                            
                            $result2 = $this->model->insertDataDetail($param_detail);
                            if($result2) {
                                $res['status'] = 200;
                                $res['success'] = true;
                                $res['msg'] = "berhasil menambahkan izin keluar kantor";
                            } else {
                                $res['status'] = 400;
                                $res['success'] = false;
                                $res['msg'] = "gagal menambahkan izin keluar kantor detail";
                            }
                        }
                        else {
                            $res['status'] = 400;
                            $res['success'] = false;
                            $res['msg'] = "gagal menambahkan izin keluar kantor";
                        }
                }
                else {
                    $res['status'] = 400;
                    $res['success'] = false;
                    $res['msg'] = "input tidak lengkap";
                }
                echo json_encode($res);
        }
    }

    public function edit($id = "") {
        if($id == "") {
            if ($this->input->server('REQUEST_METHOD') == "POST") { 
                $post = $this->input->post();
                $id = $post['id'];
                $id_detail = $post['id_detail'];
                $param = [
                    'pegawai' => $post['pegawai'],
                    'dari' => $post['dari'],
                    'sampai' => $post['sampai'],
                    'tgl_mengetahui' => $post['tgl'] ,
                    'keperluan' => $post['keperluan'],
                    'kepada' => $post['kepada'],
                    'ditetapkan' => CURRENT_DITETAPKAN,
                    'ttd' => $post['ttd'],
                ];                  
                
                #update to table izin keluar
                $result = $this->model->updateData($id, $param);
                if($result) {
                    if($post['pegawai'] == "asn") {
                        $param_detail = [
                            'id_izin' => $id,
                            'nama' => $post['nama'],
                            'nip' => $post['nip'],
                            'pangkat' => $post['pangkat'],
                            'jabatan' => $post['jabatan'],
                            'unit_kerja' => NAMA_INSTANSI
                        ];
                    }
                    else {
                        $param_detail = [
                            'id_izin' => $id,
                            'nama' => $post['nama'],
                            'jabatan' => $post['jabatan'],
                            'unit_kerja' => NAMA_INSTANSI
                        ];
                    }
                    #insert to izin keluar detail                            
                    $result2 = $this->model->updateDataDetail($id_detail, $param_detail);
                    if($result2) {
                        $res['status'] = 200;
                        $res['success'] = true;
                        $res['msg'] = "berhasil mengubah izin keluar kantor";
                    } else {
                        $res['status'] = 400;
                        $res['success'] = false;
                        $res['msg'] = "gagal mengubah izin keluar kantor detail";
                    }
                }
                else {
                    $res['status'] = 400;
                    $res['success'] = false;
                    $res['msg'] = "gagal mengubah izin keluar kantor";
                }
                echo json_encode($res);
                
                
            } //close post
        }
        else {
            $result = $this->model->getRow($id);
            if($result) {
                $res['status'] = 200;
                $res['success'] = true; 
                $res['msg'] = "get izin keluar kantor";
                $res['data'] = $result;
            }
            else {
                $res['status'] = 400;
                $res['success'] = false; 
                $res['msg'] = "get izin keluar kantor";
                $res['data'] = [];
            }
            echo json_encode($res);
        }
    }


    public function print($id) {
        $id_izin = htmlspecialchars($id);
        $result = $this->model->getRow($id_izin);
        $arrData = [
            'kepada' => $result->kepada,
            'nama' => $result->nama,
            'nip' => $result->nip,
            'jabatan' => $result->jabatan,
            'dari' => $result->dari,
            'sampai' => $result->sampai,
            'keperluan' => $result->keperluan,
            'ditetapkan' => $result->ditetapkan,
            'unit_kerja' => $result->unit_kerja,
            'ttd_nama' => $result->ttd_nama,
            'ttd_nip' => $result->ttd_nip,
            'tgl_mengetahui' => strdateIndo($result->tgl_mengetahui)
        ];


        if($result->pegawai == "asn") {
            $data = [
                'source' => "izin-keluar-kantor.docx",
                'filename' =>  $result->pegawai."-izin-keluar-kantor-".date('ymdhis').'.docx',
                'data' => $arrData,
            ];
        }
        else {
            $data = [
                'source' => "izin-keluar-kantor-ppnpn.docx",
                'filename' =>  $result->pegawai."-izin-keluar-kantor-".date('ymdhis').'.docx',
                'data' => $arrData,
            ];
        }
        $this->wordsptlib->izin($data);
    }

    public function delete($id) {
        $row = $this->model->deleteData($id);
        if($row > 0) {
            $res['success'] = true;
            $res['msg'] = "berhasil menghapus spt";
        }
        else {
            $res['success'] = false;
            $res['msg'] = "gagal menghapus spt";
        }
        echo json_encode($res);
    }







    
}
