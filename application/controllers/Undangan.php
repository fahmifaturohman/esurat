<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Undangan extends CI_Controller
{
    private $page;
    
    public function __construct()
    {
        parent::__construct();
        $this->page = "undangan";
        $this->load->model("UndanganModel", "model");
        isLogin();
    }

    public function index() 
    {
        $data = [
            'page' => $this->page,
            'title' => "list undangan",
            'data' => $this->model->getData(),
            'js' => [],
        ];
        //echo json_encode($data);
       templateView("undangan/undangan", $data);
    }

    public function add() {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
            $validation = $this->form_validation;
            $validation->set_rules($this->model->rules());

            if($validation->run()) {
                $post = $this->input->post();
                $tipe = $post['spt_tipe'];
                if($tipe == "spt kegiatan") {self::_sptkegiatan($post);}
                elseif($tipe == "spt plh") { self::_sptplh($post);}
                else { self::_sptdiklat($post);}
            }
            else {
                $res['status'] = 400;
                $res['success'] = false;
                $res['msg'] = "belum divalidasi";
                echo json_encode($res);
            }
           
            
        }        
    }
    
    private function _sptkegiatan($post) {
        $param_spt = [
            "spt_tipe" => $post['spt_tipe'],                
            'nomor' => "W8-A/   /KP.01.1/".date('m', strtotime($post['tgl'])).'/'.date('Y', strtotime($post['tgl'])),
            'penugas' => $post['penugas'],
            'ditetapkan' => "Bandar Lampung",
            'tgl' => $post['tgl'],
            'ttd' => $post['ttd'],
            'status' => 1,
        ];
        $result = $this->model->insertSpt($param_spt);
        if($result) {
            #spt kegiatan
            $param_kegiatan = [
                'id_spt' => $result,
                'kegiatan' => $post['kegiatan'],
                'tgl_kegiatan' => $post['tgl_kegiatan'],
                'tempat_kegiatan' => $post['tempat'],
                'dipa' => $post['dipa'],
                'tahun_anggaran' => $post['tahun'] 
            ];
            $this->model->insertSptKegiatan($param_kegiatan);
            #spt detail
            $count = count($post['nama']);
            $array_detail = [];
            for ($i=0; $i < $count; $i++) { 
                $array = [
                    'id_spt' => $result,
                    'nama' => $post['nama'][$i],
                    'nip' => $post['nip'][$i],
                    'pangkat' => $post['pangkat'][$i],
                    'jabatan' => $post['jabatan'][$i],
                ];
                $this->model->insertSptDetail($array);
                $array_detail[] = $array;
            }

            $res['status'] = 201;
            $res['success'] = true;
            $res['msg'] = "berhasil menambahkan spt kegiatan";
        }
        else {
            $res['status'] = 201;
            $res['success'] = true;
            $res['msg'] = "berhasil menambahkan spt kegiatan";
        }
        echo json_encode($res);
    }

    private function _sptdiklat($post) {
        $param_spt = [
            "spt_tipe" => $post['spt_tipe'],                
            'nomor' => "W8-A/   /KP.01.1/".date('m', strtotime($post['tgl'])).'/'.date('Y', strtotime($post['tgl'])),
            'penugas' => $post['penugas'],
            'ditetapkan' => "Bandar Lampung",
            'tgl' => $post['tgl'],
            'ttd' => $post['ttd'],
            'status' => 1,
        ];
        $result = $this->model->insertSpt($param_spt);
        if($result) {
            #spt diklat
            $sumber = $post['berdasarkan'].' '.$post['nomor'].' Tanggal '.strdateIndo($post['tgl_sumber']);
            $param_diklat = [
                'id_spt' => $result,
                'sumber' => $sumber,
                'tgl_sumber' => $post['tgl_sumber'],
                'perihal_sumber' => $post['perihal'],
            ];
            $diklat = $this->model->insertSptDiklat($param_diklat);
            
            #spt diklat detail
            $count_tahap = count($post['tahap']);
            $arr_tahap = [];
            for($j = 0; $j < $count_tahap; $j++) {
                $array = [
                    'id_spt_diklat' => $diklat,
                    'waktu' => $post['tahap'][$j],
                    'tempat' => $post['tempat'][$j],
                ];
                $this->model->insertSptDiklatDetail($array);
                $array_tahap[] = $array;
            }
            
            #spt detail
            $count = count($post['nama']);
            $array_detail = [];
            for ($i=0; $i < $count; $i++) { 
                $array = [
                    'id_spt' => $result,
                    'nama' => $post['nama'][$i],
                    'nip' => $post['nip'][$i],
                    'pangkat' => $post['pangkat'][$i],
                    'jabatan' => $post['jabatan'][$i],
                ];
                $this->model->insertSptDetail($array);
                $array_detail[] = $array;
            }

            $res['status'] = 201;
            $res['success'] = true;
            $res['msg'] = "berhasil menambahkan spt diklat";
        }
        else {
            $res['status'] = 201;
            $res['success'] = true;
            $res['msg'] = "berhasil menambahkan spt plh";
        }
        echo json_encode($res);
    }

    private function _sptplh($post) {
        $param_spt = [
            "spt_tipe" => $post['spt_tipe'],                
            'nomor' => "W8-A/   /KP.01.1/".date('m', strtotime($post['tgl'])).'/'.date('Y', strtotime($post['tgl'])),
            'penugas' => $post['penugas'],
            'ditetapkan' => "Bandar Lampung",
            'tgl' => $post['tgl'],
            'ttd' => $post['ttd'],
            'status' => 1,
        ];
        $result = $this->model->insertSpt($param_spt);
        if($result) {
            #spt plh
            $param_plh = [
                'id_spt' => $result,
                'plh' => $post['plh'],
                'waktu' => $post['waktu'],
                'keterangan' => $post['plh']
            ];
            $this->model->insertSptPlh($param_plh);
            #spt detail
            $count = count($post['nama']);
            $array_detail = [];
            for ($i=0; $i < $count; $i++) { 
                $array = [
                    'id_spt' => $result,
                    'nama' => $post['nama'][$i],
                    'nip' => $post['nip'][$i],
                    'pangkat' => $post['pangkat'][$i],
                    'jabatan' => $post['jabatan'][$i],
                ];
                $this->model->insertSptDetail($array);
                $array_detail[] = $array;
            }

            $res['status'] = 201;
            $res['success'] = true;
            $res['msg'] = "berhasil menambahkan spt plh";
        }
        else {
            $res['status'] = 201;
            $res['success'] = true;
            $res['msg'] = "berhasil menambahkan spt plh";
        }
        echo json_encode($res);
    }


    public function report($id) {
        $result1 = $this->model->get_spt_id($id);
        $detail = $this->model->get_spt_detail($id);
        #spt kegiatan
        if($result1->spt_tipe == "spt kegiatan") {
            $result = $this->model->getSptKegiatan($id);
            $data = [
                'nomor' => $result->nomor,
                'ditetapkan' => $result->ditetapkan,
                'tgl' => strdateIndo($result->tgl),
                'penugas' => $result->penugas,
                'nama' => $result->nama,
                'nip' => $result->username,
                'kegiatan' => $result->kegiatan,
                'tgl_kegiatan' => $result->tgl_kegiatan,
                'tempat_kegiatan' => $result->tempat_kegiatan,
                'dipa' => $result->dipa,
                'tahun_anggaran' => $result->tahun_anggaran,
            ];
            $data = [
                'source' => "spt-kegiatan.docx",
                'filename' => "spt-kegiatan ".date('ymdhis').'.docx',
                'data' => $data,
                'detail' => $detail,
                'tahap' => "",
            ];
            $this->wordsptlib->spt($data);
        }
        #spt plh
        elseif($result1->spt_tipe == "spt plh") {
            $result = $this->model->getSptPlh($id);
            $data = [
                'nomor' => $result->nomor,
                'ditetapkan' => $result->ditetapkan,
                'tgl' => strdateIndo($result->tgl),
                'penugas' => $result->penugas,
                'nama' => $result->nama,
                'nip' => $result->username,
                'plh' => $result->plh,
                'waktu' =>$result->waktu,
                'ket' => $result->keterangan,
            ];    
            $data = [
                'source' => "spt-plh.docx",
                'filename' => "spt-plh ".date('ymdhis').'.docx',
                'data' => $data,
                'detail' => $detail,
                'tahap' => "",
            ];
            $this->wordsptlib->spt($data);
        }
        #spt diklat
        elseif($result1->spt_tipe == "spt diklat") {
            $result = $this->model->getSptDiklat($id);
            $data = [
                'nomor' => $result->nomor,
                'ditetapkan' => $result->ditetapkan,
                'tgl' => strdateIndo($result->tgl),
                'penugas' => $result->penugas,
                'nama' => $result->nama,
                'nip' => $result->username,
                'sumber' => $result->sumber,
                'tgl_sumber' => strdateIndo($result->tgl_sumber),
                'perihal_sumber' => $result->perihal_sumber,
            ];
            #diklat detail
            $diklat_detail = $this->model->getSptDiklatDetail($result->id_spt_diklat);
            $data = [
                'source' => "spt-diklat.docx",
                'filename' => "spt-diklat ".date('ymdhis').'.docx',
                'data' => $data,
                'detail' => $detail,
                'tahap' => $diklat_detail,
            ];
            $this->wordsptlib->spt($data);
        }  
        
    }


    










    public function edit($id = null) {
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $validation = $this->form_validation;
            $validation->set_rules($this->model->rules());
            
            if ($validation->run()) {
                $post = $this->input->post();
                $parent = ($post['parent'] == 0) ? NULL:$post['parent'];
                $namaPegawai = $post['id_pegawai']; 
                $rowPegawai = $this->model1->getByName($namaPegawai);
                
                if($rowPegawai) {
                    $id_pegawai = $rowPegawai->id_user;               
                    $row = $this->model->update($id_pegawai, $parent);
                    
                    if($row) {
                        $res['success'] = true;
                        $res['msg'] = "berhasil mengubah data";
                    }
                    else {
                        $res['success'] = false;
                        $res['msg'] = "gagal mengubah data";
                    }
                }
                else {
                    $res['success'] = false;
                    $res['msg'] = "Pegawai belum terdaftar, silahkan tambah pegawai terlebih dahulu";
                }
                echo json_encode($res); 
            }
        }
        else {
            $res = $this->model->getById($id);
            $data = [
                'page' => $this->page,
                'title' => "Pimpinan",
                'js' => ['pimpinan'],
                'data' => $res,
                'parent' => $this->model->getParent(),
            ];
            templateView("pimpinan/edit", $data);
        }
    }








    public function delete() {
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $row = $this->model->delete_spt();
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
        else {
            redirect('errorpage');  
        }
    }







    
}
