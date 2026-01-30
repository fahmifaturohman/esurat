<?php

use phpDocumentor\Reflection\Types\Parent_;

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    private $page;
    private $instansi;
    
    public function __construct()
    {
        parent::__construct();
        $this->page = "pegawai";
        $this->load->model("PegawaiModel", "model");
        $this->load->model("PegawaiSipecutModel", "model1");
        $this->load->model("PegawaiSipecutV1Model", "model2");
        $this->load->model("PegawaiSigerModel", 'modelsiger');
        $this->load->model("DataTable", "dataTable");
        $this->load->model("DataTable3", "dataTable3");
        $this->instansi = NAMA_INSTANSI;
        isLogin();
    }

    public function index() {
        $data = [
            'page' => $this->page,
            'title' => "Pegawai",
            'data' =>[],
            'js' => ['pegawai'],
        ];

        templateView("pegawai/pegawai", $data);
    }

    public function table() {
        $tables = "pegawai";
        $search = array('nama','nip', 'email', 'tgl_lahir', 'jabatan', 'golongan', 'nama_golongan', 'no_hp', 'nama_satker', 'active');
        $where = ['nama_satker' => NAMA_INSTANSI, 'active' => 1];
        $isWhere = null;
        header('Content-Type: application/json');
        echo $this->dataTable->get_tables_where($tables, $search, $where, $isWhere);
    }

    public function perbarui() {
        self::perbarui_v1();
    }

    public function perbarui_v2() {
        $satker = $this->instansi;
        $pegawai = $this->apisipecut->apiPegawai($satker);
        $res = json_decode($pegawai);
        $arr = [];
        // foreach($res->data as $key) {
        //     $data = [
        //         'id_pegawai' => $key->id,
        //         'username' => $key->username,
        //         'password' => md5($key->nip),
        //         'nip' => $key->nip,
        //         'nama' => $key->nama,
        //         'email' => $key->email,
        //         'jabatan' => $key->jabatan,
        //         'tgl_lahir' => $key->tgl_lahir,
        //         'kode_satker' => $key->kode_satker,
        //         'nama_satker' => $key->nama_satker,
        //         'id_jabatan' => $key->id_jabatan,
        //         'id_posisi_jabatan' => $key->id_posisi_jabatan,
        //         'golongan' => $key->golongan,
        //         'nama_golongan' => $key->nama_golongan,
        //         'email_pegawai' => $key->email_pegawai,
        //         'no_hp' => $key->no_hp,
        //         'foto' => $key->foto,
        //         'nama_posisi_jabatan' => $key->nama_posisi_jabatan,
        //         'active' => $key->active,
        //     ];
        //     $row = $this->model->updateOrCreate($data);
        //     $arr[] = $row;
        // }
        // echo json_encode(['status' => 201, 'success' => true, 'msg' => 'berhasil memperbarui '.count($arr). ' data']);
        echo json_encode($res);
    }

    public function perbarui_v1() {
        $satker = "PTA Bandar Lampung";
        $pegawai = $this->model2->getAll($satker);
        $arr = [];
        $array_pangkat = [
            'i/a' => 'Juru Muda', 'i/b'=> 'Juru Muda Tingkat I', 'i/c'=> 'Juru','i/d'=> 'Juru Tingkat I', 
            'ii/a' => 'Pengatur Muda', 'ii/b'=> 'Pengatur Muda Tingkat I', 'ii/c'=> 'Pengatur','ii/d'=> 'Pengatur Tingkat I', 
            'iii/a' => 'Penata Muda', 'iii/b'=> 'Penata Muda Tingkat I', 'iii/c'=> 'Penata','iii/d'=> 'Penata Tingkat I', 
            'iv/a' => 'Pembina', 'iv/b'=> 'Pembina Tingkat I', 'iv/c'=> 'Pembina Utama Muda','iv/d'=> 'Pembina Utama Madya', 'iv/e'=> 'Pembina Utama', 
        ];
        foreach ($pegawai as $key) {
            if ($key->golongan == "-" || strtolower($key->golongan) == "it" || strlen($key->nip) < 18) { continue; }
            $exp = explode(" ", $key->unit_kerja);
            if($exp[0] == "PA") { $str1 = "PA"; $str2 = "Pengadilan Agama";} 
            else { $str1 = "PTA"; $str2 = "Pengadilan Tinggi Agama"; }
            
            $gol = str_replace(" ","", strtolower($key->golongan));
            $gol = str_replace(")","", str_replace("(","", strtolower($gol))); 
            
            if (!array_key_exists($gol,$array_pangkat)) { 
                $nama_golongan = "";
                $gol = $key->golongan;
             }
            else {
                $nama_golongan = $array_pangkat[$gol];
                $exp2 = explode("/",$gol);
                $gol = strtoupper($exp2[0]).'/'.$exp2[1];
            }
           
            
            $data = [
                'id_pegawai' => $key->id,
                'username' => $key->username,
                'password' => md5($key->nip),
                'nip' => $key->nip,
                'nama' => $key->nama,
                'email' => "",
                'jabatan' => $key->jabatan,
                'tgl_lahir' => $key->tgl_lahir,
                'kode_satker' => "",
                'nama_satker' => str_replace($str1,$str2,$key->unit_kerja),
                'id_jabatan' => "",
                'id_posisi_jabatan' => "",
                'golongan' => $gol,
                'nama_golongan' => $nama_golongan,
                'email_pegawai' => "",
                'no_hp' => $key->no_hp,
                'foto' => "",
                'nama_posisi_jabatan' => $key->jabatan,
                'active' => $key->status,
            ];
            $row = $this->model->updateOrCreate($data);
            $arr[] = $row;
        }
        echo json_encode(['status' => 201, 'success' => true, 'msg' => 'berhasil memperbarui '.count($arr). ' data']);
    }
    
    public function perbarui_by_siger() {
        $satker = $this->instansi;
        $pegawai = $this->modelsiger->getAll($satker);
        $arr = [];
        foreach ($pegawai as $key) {
            $data = [
                'id_pegawai' => $key->id,
                'username' => $key->username,
                'password' => md5($key->nip),
                'nip' => $key->nip,
                'nama' => $key->nama,
                'email' => $key->email,
                'jabatan' => $key->jabatan,
                'tgl_lahir' => $key->tgl_lahir,
                'kode_satker' => $key->kode_satker,
                'nama_satker' => $key->nama_satker,
                'id_jabatan' => $key->id_jabatan,
                'id_posisi_jabatan' => $key->id_posisi_jabatan,
                'golongan' => $key->golongan,
                'nama_golongan' => $key->nama_golongan,
                'email_pegawai' => $key->email_pegawai,
                'no_hp' => $key->no_hp,
                'foto' => $key->foto,
                'nama_posisi_jabatan' => $key->nama_posisi_jabatan,
                'active' => $key->active,
            ];
            $row = $this->model->updateOrCreate($data);
            $arr[] = $row;
        }
        echo json_encode(['status' => 201, 'success' => true, 'msg' => 'berhasil memperbarui '.count($arr). ' data']);
    }


    public function nonaktifkan() {
        if ($this->input->server('REQUEST_METHOD') == "POST") {  
            $post = $this->input->post();
            $data = [
                'id' => $post['id'],
                'is_active' => $post['is_active']
            ];
            $row = $this->model1->updateStatus($post);
            if($row > 0) {
                $res['success'] = true;
                $res['msg'] = "berhasil menonaktifkan pegawai";
            }
            else {
                $res['success'] = true;
                $res['msg'] = "gagal menonaktifkan pegawai";
            }
            echo json_encode($res);

        }
        else {
            redirect('errorpage');  
        }
    }

    

    public function add() {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
            $validation = $this->form_validation;
            $validation->set_rules($this->model->rules());
           
            if ($validation->run()) {
                $post = $this->input->post();
                $parent = ($post['parent'] == 0) ? NULL:$post['parent'];
                $namaPegawai = $post['id_pegawai']; 
                $rowPegawai = $this->pegawai->getByName($namaPegawai);
                
                if($rowPegawai) {
                    $id_pegawai = $rowPegawai->id_pegawai;               
                    $row = $this->model->save($id_pegawai, $parent);
                    
                    if($row) {
                        $res['success'] = true;
                        $res['msg'] = "berhasil menambahkan data";
                    }
                    else {
                        $res['success'] = false;
                        $res['msg'] = "gagal menambahkan data";
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
            $data = [
                'page' => $this->page,
                'title' => "Pegawai",
                'js' => ['pegawai'],
            ];
            templateView("pegawai/add", $data);
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
                $rowPegawai = $this->pegawai->getByName($namaPegawai);
                
                if($rowPegawai) {
                    $id_pegawai = $rowPegawai->id_pegawai;               
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
                    $res['msg'] = "Pegawai belum terdaftar, silahkan tambah pegawai terlebihdahulu";
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
            $row = $this->model->delete();
            if($row > 0) {
                $res['success'] = true;
                $res['msg'] = "berhasil menghapus data";
            }
            else {
                $res['success'] = false;
                $res['msg'] = "gagal menghapus data";
            }
            echo json_encode($res);
        }
        else {
            redirect('errorpage');  
        }
    }

    public function permanentdelete($id = null) {
        $row = $this->model->hardDelete($id);
        if($row > 0) {
            $res['success'] = true;
            $res['msg'] = "hapus permanen berhasil";
        }
        else {
            $res['success'] = false;
            $res['msg'] = "hapus permanen gagal";
        }
        echo json_encode($res);
    }





    /* CUSTOM METHOD */
    public function caripegawai($name = null) {
        $name = urldecode($name);
        $row = $this->pegawai->getLikeName($name);
        if($row) {
            $res['success'] = true;
            $res['message'] = "cari pegawai";
            $res['data'] = $row;
        }
        else {
            $res['success'] = false;
            $res['message'] = "cari pegawai";
            $res['data'] = [];
        }
        echo json_encode($res);
    }

    #validasi bagian
    public function cekbagian($name = null) {
        $name = urldecode($name);
        $row = $this->model->getByName($name);
        if($row) {
            $res['success'] = true;
            $res['msg'] = "nama bagian sudah ada";
            $res['data'] = $row;
        }
        else {
            $res['success'] = false;
            $res['msg'] = "nama bagian belum ada";
            $res['data'] = [];
        }
        $res['name'] = $name;
        echo json_encode($res);
    }
  
    public function addnote() {
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $row = $this->model->addNote();
            if($row > 0) {
                $res['success'] = true;
                $res['msg'] = "catatan berhasil ditambahkan";
            }
            else {
                $res['success'] = false;
                $res['msg'] = "catatan gagal ditambahkan";
            }
            echo json_encode($res);
        }
        else {
            redirect('errorpage');
        }
    }

    public function addpegawai() {
        if($this->input->server('REQUEST_METHOD') == "POST") {            
            $post = $this->input->post();
            $namaPegawai = $post['id_pegawai']; 
            $rowPegawai = $this->pegawai->getByName($namaPegawai);
            
            if($rowPegawai) {
                $id_pegawai = $rowPegawai->id_pegawai;               
                $row = $this->model->addPegawai($id_pegawai);
                
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
                $res['msg'] = "Pegawai belum terdaftar, silahkan tambah pegawai terlebihdahulu";
            }
            echo json_encode($res);    
        }
        else {
            redirect('errorpage');
        }
    }






    
}
