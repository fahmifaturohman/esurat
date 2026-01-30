<?php

use phpDocumentor\Reflection\Types\Parent_;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

defined('BASEPATH') OR exit('No direct script access allowed');

class Spt extends CI_Controller
{
    private $page;
    private $sess;
    
    public function __construct()
    {
        parent::__construct();
        $this->page = "spt";
        $this->sess = $this->session->userdata(MY_SESSION_DATA);
        $this->load->model("SptModel", "model");
        $this->load->model("PegawaiSipecutModel", "model1");
        $this->load->model("PegawaiModel", "pegawai");
        $this->load->model("AsalTujuanModel", "asalTujuan");
        $this->load->model("StaticModel", "static");
        $this->load->model("DataTable", "dataTable");
        isLogin();
    }

    public function index() 
    {
        $data = [
            'page' => $this->page,
            'title' => "spt",
            'data' => ['dipa' => $this->static->dipa()],
            'js' => ["spt"],
        ];
        templateView("spt/spt", $data);
    }

    public function table() {
        $tables = "view_spt";
        $search = array('spt_tipe','nomor','penugas','tgl','peserta');
        $where = ['status' => 1, 'tahun' => CURRENT_YEAR];
        $isWhere = null;
        header('Content-Type: application/json');
        echo $this->dataTable->get_tables_where($tables, $search, $where, $isWhere);
    }

    public function table_spt_kegiatan() {
        $tables = "view_spt_kegiatan";
        $search = array('spt_tipe','nomor','penugas','tgl','kegiatan','tgl_kegiatan','dipa','peserta', 'tempat_kegiatan');
        $where = ['tahun' => CURRENT_YEAR];
        $isWhere = null;
        header('Content-Type: application/json');
        echo $this->dataTable->get_tables_where($tables, $search, $where, $isWhere);
    }

    public function table_spt_plh() {
        $tables = "view_spt_plh";
        $search = array('nomor','penugas', 'tgl','peserta','peserta_pangkat','peserta_jabatan','plh','waktu');
        $where = ['tahun' => CURRENT_YEAR];
        $isWhere = null;
        header('Content-Type: application/json');
        echo $this->dataTable->get_tables_where($tables, $search, $where, $isWhere);
    }

    public function table_spt_diklat() {
        $tables = "view_spt_diklat";
        $search = array('nomor','penugas','tgl');
        $where = ['status' => 1, 'tahun' => CURRENT_YEAR];
        $isWhere = null;
        header('Content-Type: application/json');
        echo $this->dataTable->get_tables_where($tables, $search, $where, $isWhere);
    }






    public function spt_kegiatan() {
        $data = [
            'page' => "spt-kegiatan",
            'title' => "spt kegiatan",
            'data' => ["dipa" => $this->static->dipa()],
            'js' => ["spt"],
        ];
        templateView("spt/spt-kegiatan", $data);
    }

    public function spt_plh() {
        $data = [
            'page' => "spt-plh",
            'title' => "spt plh",
            'data' => $this->model->view_spt_plh(),
            'js' => ["spt"],
        ];
        templateView("spt/spt-plh", $data);
    }

    public function spt_diklat() {
        $data = [
            'page' => "spt-diklat",
            'title' => "spt diklat",
            'data' => [],
            'js' => ["spt"],
        ];
        templateView("spt/spt-diklat", $data);
    }


    





    public function add() {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
            $validation = $this->form_validation;
            $validation->set_rules('spt_tipe','SPT TIPE','required');

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
            'nomor' => "W8-A/        /KP.01.1/".((int) date('m', strtotime($post['tgl']))).'/'.date('Y', strtotime($post['tgl'])),
            'penugas' => $post['penugas'],
            'ditetapkan' => "Bandar Lampung",
            'tgl' => $post['tgl'],
            'ttd' => $post['ttd'],
            'status' => 1,
            'create_by' => $this->sess->username
        ];
        $result = $this->model->insertSpt($param_spt);
        if($result) {
            #spt kegiatan
            $param_kegiatan = [ 
                'id_spt' => $result,
                'kegiatan' => $post['kegiatan'],
                'tgl_kegiatan' => daterangeIndo($post['tgl_kegiatan']),
                'tempat_kegiatan' => $post['tempat'],
                'alamat_kegiatan' => $post['alamat'],
                'dipa_status' => $post['dipa_status'],
                'dipa' => ($post['dipa_status'] == 0 ) ? NULL:$post['dipa'],
                'tahun_anggaran' => ($post['dipa_status'] == 0 ) ? NULL:$post['tahun'] 
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

            #update or insert asal tujuan
            $param_asal_tujuan = ['asal_tujuan' => $post['tempat'], 'alamat' => $post['alamat']];
            $this->asalTujuan->insertOrUpdate_asalTujuan($param_asal_tujuan);

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
            'nomor' => "W8-A/        /KP.01.1/".((int) date('m', strtotime($post['tgl']))).'/'.date('Y', strtotime($post['tgl'])),
            'penugas' => $post['penugas'],
            'ditetapkan' => "Bandar Lampung",
            'tgl' => $post['tgl'],
            'ttd' => $post['ttd'],
            'status' => 1,
            'create_by' => $this->sess->username
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
            'nomor' => "W8-A/        /KP.01.1/".((int) date('m', strtotime($post['tgl']))).'/'.date('Y', strtotime($post['tgl'])),
            'penugas' => $post['penugas'],
            'ditetapkan' => "Bandar Lampung",
            'tgl' => $post['tgl'],
            'ttd' => $post['ttd'],
            'status' => 1,
            'create_by' => $this->sess->username
        ];
        $result = $this->model->insertSpt($param_spt);
        if($result) {
            #spt plh
            $param_plh = [
                'id_spt' => $result,
                'plh' => $post['plh'],
                'waktu' => daterangeIndo($post['waktu']),
                'keterangan' => $post['plh'],
                'alasan' => $post['alasan'],
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

    /* for update*/
    private function _updateSpt($post) {
        $id_spt = $post['id_spt'];
        $param_spt = [
            "spt_tipe" => $post['spt_tipe'],                
            'nomor' => "W8-A/        /KP.01.1/".((int) date('m', strtotime($post['tgl']))).'/'.date('Y', strtotime($post['tgl'])),
            'penugas' => $post['penugas'],
            'tgl' => $post['tgl'],
            'ttd' => $post['ttd'],
        ];
        $updateSPt = $this->model->updateSpt($id_spt, $param_spt);
        return $updateSPt;
    }

    private function _updateSptDetail($post) {
        $id_spt = $post['id_spt'];
        $count = count($post['nama']);
        $array_detail = [];
        for ($i=0; $i < $count; $i++) { 
            #update spt detail
            if(!empty($post['id_spt_detail'][$i])) {
                $id_spt_detail = $post['id_spt_detail'][$i];
                $array = [
                    'id_spt' => $id_spt,
                    'nama' => $post['nama'][$i],
                    'nip' => $post['nip'][$i],
                    'pangkat' => $post['pangkat'][$i],
                    'jabatan' => $post['jabatan'][$i],
                ];
                $this->model->updateSptDetail($id_spt_detail, $array);
                $array_detail[] = $array;
            }
            #tambah spt detail
            else {
                $array = [
                    'id_spt' => $id_spt,
                    'nama' => $post['nama'][$i],
                    'nip' => $post['nip'][$i],
                    'pangkat' => $post['pangkat'][$i],
                    'jabatan' => $post['jabatan'][$i],
                ];
                $this->model->insertSptDetail($array);
                $array_detail[] = $array;
            }                   
        }
        return true; 
    }    

    private function _deletePermanentSptDetail($post) {
        if(!empty($post['id_spt_detail_hapus'])) {
            $count = count($post['id_spt_detail_hapus']);
            $array = [];
            for ($i=0; $i < $count; $i++) { 
                $id = $post['id_spt_detail_hapus'][$i];
                $array[] = $id;
                $hapus = $this->model->deletePermanentSptDetail($id);
            } 
            return true;
        } else { return false;}
    }

    private function _updateSptDiklatDetail($post) {
        $count = count($post['tahap']);
        $array_detail = [];
        for ($i=0; $i < $count; $i++) { 
            #update spt detail
            if(!empty($post['id_spt_diklat_detail'][$i])) {
                $id_spt_diklat_detail = $post['id_spt_diklat_detail'][$i];
                $array = [
                    'id_spt_diklat' => $post['id_spt_diklat'],
                    'waktu' => $post['tahap'][$i],
                    'tempat' => $post['tempat'][$i],
                ];
                $this->model->updateSptDiklatDetail($id_spt_diklat_detail, $array);
                $array_detail[] = $array;
            }
            #tambah spt detail
            else {
                $array = [
                    'id_spt_diklat' => $post['id_spt_diklat'],
                    'waktu' => $post['tahap'][$i],
                    'tempat' => $post['tempat'][$i],
                ];
                $this->model->insertSptDiklatDetail($array);
                $array_detail[] = $array;
            }                   
        }
        return true; 
    }    

    private function _deletePermanentSptDiklatDetail($post) {
        if(!empty($post['id_spt_diklat_detail_hapus'])) {
            $count = count($post['id_spt_diklat_detail_hapus']);
            $array = [];
            for ($i=0; $i < $count; $i++) { 
                $id = $post['id_spt_diklat_detail_hapus'][$i];
                $array[] = $id;
                $hapus = $this->model->deletePermanentSptDiklatDetail($id);
            } 
            return true;
        } else { return false;}
    }
    /* close update */


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
                'alamat_kegiatan' => $result->alamat_kegiatan,
                'dipa' => $result->dipa,
                'dipa_status' => $result->dipa_status,
                'tahun_anggaran' => $result->tahun_anggaran,
            ];
            
            $source = ($data['dipa_status'] == 0) ? "spt-kegiatan-non-dipa.docx":"spt-kegiatan.docx";
            $file = ($data['dipa_status'] == 0) ? "spt-kegiatan-nondipa":"spt-kegiatan";
            $data = [
                'source' => $source,
                'filename' => $file.date('ymdhis').'.docx',
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
                'alasan' => ucwords($result->alasan),
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


   

    public function edit_spt_kegiatan($id = null) {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
            $validation = $this->form_validation;
            $validation->set_rules('spt_tipe','SPT TIPE','required');
            if($validation->run()) {
                #spt
                $post = $this->input->post();
                self::_updateSpt($post);
                self::_updateSptDetail($post);                   
                self::_deletePermanentSptDetail($post);                
                #spt kegiatan tgl_kegiatan_old
                $id_spt_kegiatan = $post['id_spt_kegiatan'];
                $param_kegiatan = [ 
                    'kegiatan' => $post['kegiatan'],
                    'tgl_kegiatan' =>($post['tgl_kegiatan'] != $post['tgl_kegiatan_old']) ? daterangeIndo($post['tgl_kegiatan']) : $post['tgl_kegiatan'],
                    'tempat_kegiatan' => $post['tempat'],
                    'alamat_kegiatan' => $post['alamat'],
                    'dipa_status' => $post['dipa_status'],
                    'dipa' => ($post['dipa_status'] == 0 ) ? NULL:$post['dipa'],
                    'tahun_anggaran' => ($post['dipa_status'] == 0 ) ? NULL:$post['tahun'] 
                ];
                $this->model->updateSptKegiatan($id_spt_kegiatan, $param_kegiatan);     
                $res['status'] = 200;
                $res['success'] = true;
                $res['msg'] = "berhasil update spt kegiatan";
                echo json_encode($res);
            }
            else {
                $res['status'] = 400;
                $res['success'] = false;
                $res['msg'] = "belum divalidasi";
                echo json_encode($res);
            }        
        }
        else {
            $result1 = $this->model->get_spt_id($id);
            $detail = $this->model->get_spt_detail($id);
            $result = $this->model->getSptKegiatan($id);
            $data = [
                'spt' => $result1,
                'detail' => $detail,
                'data' => ["data" => $result, "dipa" => $this->static->dipa()],
                'page' => $this->page,
                'title' => "Edit SPT Kegiatan",
                'js' => ["spt-kegiatan"]
            ];
            templateView("spt/edit_kegiatan", $data);
        }
    }


    public function edit_spt_plh($id = null) {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
            $validation = $this->form_validation;
            $validation->set_rules('spt_tipe','SPT TIPE','required');
            if($validation->run()) {
                #spt
                $post = $this->input->post();
                self::_updateSpt($post);
                self::_updateSptDetail($post);                   
                self::_deletePermanentSptDetail($post);                
                $id_spt_plh = $post['id_spt_plh'];   
                $param_plh = [
                    'plh' => $post['plh'],
                    'waktu' => ($post['waktu'] != $post['waktu_old']) ? daterangeIndo($post['waktu']) : $post['waktu'],
                    'keterangan' => $post['plh'],
                    'alasan' => $post['alasan'],
                ];
                $this->model->updateSptPlh($id_spt_plh, $param_plh);  
                $res['status'] = 200;
                $res['success'] = true;
                $res['msg'] = "berhasil update spt plh";
                echo json_encode($res);
            }
            else {
                $res['status'] = 400;
                $res['success'] = false;
                $res['msg'] = "belum divalidasi";
                echo json_encode($res);
            }        
        }
        else {
            $result1 = $this->model->get_spt_id($id);
            $detail = $this->model->get_spt_detail($id);
            $result = $this->model->getSptPlh($id);
            $data = [
                'spt' => $result1,
                'detail' => $detail,
                'data' => $result,
                'plh' => ["Ketua","Panitera", "Sekretaris"],
                'alasan' => ["dinas luar", "cuti"],
                'page' => $this->page,
                'title' => "Edit SPT PLH",
                'js' => ["spt-plh"]
            ];
            templateView("spt/edit_plh", $data);
        }
    }

    public function edit_spt_diklat($id = null) {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
            $validation = $this->form_validation;
            $validation->set_rules('spt_tipe','SPT TIPE','required');
            if($validation->run()) {
                #spt
                $post = $this->input->post();
                self::_updateSpt($post);
                self::_updateSptDetail($post);                   
                self::_deletePermanentSptDetail($post);       
                self::_updateSptDiklatDetail($post);
                self::_deletePermanentSptDiklatDetail($post); 

                $id_spt_diklat = $post['id_spt_diklat'];   
                $param_diklat = [
                    'sumber' => $post['berdasarkan'],
                    'tgl_sumber' => $post['tgl_sumber'],
                    'perihal_sumber' => $post['perihal'],
                ];
                $this->model->updateSptDiklat($id_spt_diklat, $param_diklat);  
                $res['status'] = 200;
                $res['success'] = true;
                $res['msg'] = "berhasil update spt diklat";
                echo json_encode($res);
            }
            else {
                $res['status'] = 400;
                $res['success'] = false;
                $res['msg'] = "belum divalidasi";
                echo json_encode($res);
            }        
        }
        else {
            $result1 = $this->model->get_spt_id($id);
            $detail = $this->model->get_spt_detail($id);
            $result = $this->model->getSptDiklat($id);
            $tahap = $this->model->getSptDiklatDetail($result->id_spt_diklat);
            $data = [
                'spt' => $result1,
                'detail' => $detail,
                'data' => $result,
                'tahap' => $tahap,
                'page' => $this->page,
                'title' => "Edit SPT Diklat",
                'js' => ["spt-diklat"]
            ];
            templateView("spt/edit_diklat", $data);
            //echo json_encode($data);
            
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
