<?php

use phpDocumentor\Reflection\Types\Parent_;

defined('BASEPATH') OR exit('No direct script access allowed');

class Klasifikasi extends CI_Controller
{
    private $page;
    
    public function __construct()
    {
        parent::__construct();
        $this->page = "klasifikasi";
        $this->load->model("KlasifikasiModel", "model");
        $this->load->model("DataTable", "dataTable");
        isLogin();
    }

    public function index() 
    {
        $data = [
            'page' => $this->page,
            'title' => "Klasifikasi Surat",
            'data' => $this->model->getAll(),
            'js' => ['klasifikasi'],
        ];
        templateView("klasifikasi/klasifikasi", $data);
    }

    public function table() {
        $tables = "ref_klasifikasi";
        $search = array('kode', 'nama', 'uraian');
        $where = ['deleted' => 0];
        $isWhere = null;
        header('Content-Type: application/json');
        echo $this->dataTable->get_tables_where($tables, $search, $where, $isWhere);
    }

    public function add() {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
            $validation = $this->form_validation;
            $validation->set_rules($this->model->rules());

            if ($validation->run()) {
                $row = $this->model->save();
                if($row) {
                    $res['success'] = true;
                    $res['msg'] = "berhasil menambahkan data";
                }
                else {
                    $res['success'] = false;
                    $res['msg'] = "gagal menambahkan data";
                }
                echo json_encode($res);
            }
        } 
        else {
            $data = [
                'page' => $this->page,
                'title' => "Klasifikasi Surat",
                'js' => ['klasifikasi'],
            ];
            templateView("klasifikasi/add", $data);
        }
    }

    public function edit($id = null) {
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $validation = $this->form_validation;
            $validation->set_rules($this->model->rules());

            if ($validation->run()) {
                $row = $this->model->update();
                if($row) {
                    $res['success'] = true;
                    $res['msg'] = "berhasil mengubah data";
                }
                else {
                    $res['success'] = false;
                    $res['msg'] = "gagal mengubah data";
                }
                echo json_encode($res);
            }
        }
        else {
            $row = $this->model->getById($id);
            if($row) {
                $res['success'] = true;
                $res['msg'] = "get klasifikasi berhasil";
                $res['data'] = $row;
            }
            else {
                $res['success'] = false;
                $res['msg'] = "get klasifikasi gagal";
                $res['data'] = $row;
            }
            echo json_encode($res);
        }
    }

    public function delete() {
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $row = $this->model->delete();
            if($row) {
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
        if($row) {
            $res['success'] = true;
            $res['msg'] = "hapus permanen berhasil";
        }
        else {
            $res['success'] = false;
            $res['msg'] = "hapus permanen gagal";
        }
        echo json_encode($res);
    }






    #chek validtaion
    public function cekKode() {
        $row = $this->model->getKode();
        if($row != null) {           
            $res['success'] = true;
            $res['msg'] = "kode sudah ada, silahkan gunakan kode yang lain";  
        }
        else {
            $res['success'] = false;
            $res['msg'] = "kode belum tersedia"; 
        }
        echo json_encode($res);
    }

    #cari klasifikasi
    public function cariKlasifikasi() {
        $get = $this->input->get();
        $name = $get['search'];
        $row = $this->model->getLikeName($name);
        echo json_encode($row);
    }
}
