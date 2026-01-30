<?php

use phpDocumentor\Reflection\Types\Parent_;

defined('BASEPATH') OR exit('No direct script access allowed');

class Asaltujuan extends CI_Controller
{
    private $page;
    
    public function __construct()
    {
        parent::__construct();
        $this->page = "asaltujuan";
        $this->load->model("AsalTujuanModel", "model");
        $this->load->model("DataTable", "dataTable");
        isLogin();
    }

    public function index() 
    {
        $data = [
            'page' => $this->page,
            'title' => "Asal Tujuan Surat",
            'data' => [],
            'js' => ['asaltujuan'],
        ];
        templateView("asaltujuan/asaltujuan", $data);
    }

    public function table() {
        $tables = "view_asal_tujuan";
        $search = array('asal_tujuan','alamat');
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
                'title' => "Asal Tujuan Surat",
                'js' => ['asaltujuan'],
            ];
            templateView("asaltujuan/add", $data);
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
                $res['msg'] = "get asal tujuan berhasil";
                $res['data'] = $row;
            }
            else {
                $res['success'] = false;
                $res['msg'] = "get asal tujuan gagal";
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
    public function cariTujuan($search = "") {
        $name = urldecode($search);
        $row = $this->model->getLikeTujuan($name);
        if($row) {
            $res['success'] = true;
            $res['message'] = "cari tempat";
            $res['data'] = $row;
        }
        else {
            $res['success'] = false;
            $res['message'] = "cari tempat";
            $res['data'] =  [];
        }
        echo json_encode($res);
    }

    public function cariTujuanRow() {
        $post = $this->input->post();
        $name = $post['tempat'];
        $row = $this->model->getName($name);
        if($row) {
            $res['success'] = true;
            $res['message'] = "tempat ditemukan";
            $res['data'] = $row;
        }
        else {
            $res['success'] = false;
            $res['message'] = "tempat tidak ditemukan";
            $res['data'] = [];
        }
        echo json_encode($res);    
    }


    public function testku() {
        $data = ['asal_tujuan' => "Mahkamah Agung RI1", 'alamat' => "test alamat"];
        $a = $this->model->insertOrUpdate_asalTujuan($data);
        echo json_encode($a);
    }
}
