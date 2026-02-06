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
        $this->load->model("PegawaiSigerModel", 'modelsiger');
        $this->load->model("DataTable", "dataTable");
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
        echo json_encode(['status' => 201, 'success' => true, 'msg' => 'berhasil memperbarui perbarui data pegawai dari siperading']);
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
