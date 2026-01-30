<?php

use phpDocumentor\Reflection\Types\Parent_;

defined('BASEPATH') OR exit('No direct script access allowed');

class Suratmasuk extends CI_Controller
{
    private $page;
    
    public function __construct()
    {
        parent::__construct();
        $this->page = "suratmasuk";
        $this->load->model("SuratMasukModel", "model");
        $this->load->model("DisposisiModel", "model2");
        $this->load->model("PegawaiSipecutModel", "model3");
        $this->load->model("DataTable", "dataTable");
        isLogin();
    }

    public function index() {
        $data = [
            'page' => $this->page,
            'title' => "Surat Masuk",
            'js' => ['surat-masuk'],
        ];
        templateView('suratmasuk/suratmasukServerSide', $data);
    }
    
    public function table(){
        $query = "SELECT 
                c.*,
                d.`id_asal_tujuan`, d.`asal_tujuan`, 
                a.`id_struktur`, a.`bagian`, a.`parent`, a.`note` catatan, a.`id_pegawai` pegawai,
                b.`id` `id_user`, b.`nama`, b.`username`, b.`no_hp` no_telepon
            FROM `tb_surat_masuk` c
            LEFT JOIN `m_struktur` a ON a.`id_struktur` = c.`tujuan`
            LEFT JOIN `siger2`.`users` b ON a.`id_pegawai` = b.`id`
            LEFT JOIN `tb_asal_tujuan` d ON c.`asal_surat` = d.`id_asal_tujuan`";

            $search = array('nama','username','tahun', 'perihal', 'no_surat', 'sifat_surat', 'asal_tujuan');
            $where  = [
                'c.deleted' => 0,
                //'c.tahun' => CURRENT_YEAR,
                'a.id_profile' => ID_INSTANSI
            ];
            header('Content-Type: application/json');
            echo $this->dataTable->get_tables_query($query,$search,$where,NULL);
    }


    public function index2() 
    {
        $data = [
            'page' => $this->page,
            'title' => "Surat Masuk",
            'data' => $this->model->getAll(),
            'js' => ['surat-masuk'],
        ];
        TemplateView("suratmasuk/suratmasuk", $data);
    }

    public function add() {
        if ($this->input->server('REQUEST_METHOD') == "POST") { 
            $validation = $this->form_validation;
            $validation->set_rules($this->model->rules());
           
            if ($validation->run()) {
                $post = $this->input->post();
                $parent = ($post['parent'] == 0) ? NULL:$post['parent'];
                $namaPegawai = $post['id_pegawai']; 
                $rowPegawai = $this->model1->getByName($namaPegawai);
                
                if($rowPegawai) {
                    $id_pegawai = $rowPegawai->id_user;               
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
                'title' => "Surat Masuk",
                'last' => $this->model->getLastSuratMasuk(),
                'js' => ['surat-masuk'],
            ];
            templateView("suratmasuk/add", $data);
            #echo json_encode($data);
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


    /* VALIDASI */
    public function validnoagenda($search = null) {
        $no_agenda = urldecode($search);
        $row = $this->model-> getNoAgenda($no_agenda);
        if($row) {
            $res['success'] = true;
            $res['msg'] = "no agenda sudah digunakan, silahkan gunakan kode yang lain";  
        }
        else {
            $res['success'] = false;
            $res['msg'] = "no agenda belum digunakan";
        }
        echo json_encode($res);
    }


    /* CUSTOM METHOD */
    public function disposisi($id = null) {
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $post = $this->input->post();
            $id = $post['id'];
            $id_level = $post['id_disposisi_level'];
            $row = $this->model2->getDisposisiLevelbyId($id_level);

            #disposisi lanjutan
            $dataDisposisi = $this->model->get_disposisi_masuk_last($id);
            if($dataDisposisi) {
                $param = [
                    'id_disposisi_level' => $row->id_disposisi_level,
                    'id_surat' => $id,
                    'dari' => $dataDisposisi->bagian,
                    'id_struktur' => $row->id_struktur,
                    'bagian' => $row->bagian,
                    'nama' => $row->nama,
                    'telp' => $row->no_telepon,
                    'tgl' => CURRENT_DATE,
                    'catatan' => $post['catatan'],
                    'status' => ($row->catatan == "distribusi") ? "distribusikan":"disposisikan",                
                ]; 
                $add = $this->model->add_disposisi($param);
            }
            #add disposisi pertama dari ptsp
            else {
                $param = [
                    'id_disposisi_level' => $row->id_disposisi_level,
                    'id_surat' => $id,
                    'dari' => "PTSP",
                    'id_struktur' => $row->id_struktur,
                    'bagian' => $row->bagian,
                    'nama' => $row->nama,
                    'telp' => $row->no_telepon,
                    'tgl' => CURRENT_DATE,
                    'catatan' => $post['catatan'],
                    'status' => "disposisikan",                
                ]; 
                $add = $this->model->add_disposisi($param);
            }

            if($add > 0) {
                $this->model->update_status_surat($id);
                $res['success'] = true;
                $res['msg'] = "berhasil disposisi surat masuk";
            }
            else {
                $res['success'] = false;
                $res['msg'] = "gagal disposisi surat masuk";
            }
            echo json_encode($res);
        }

        #view
        else {
            #disposisi lanjutan            
            $dataDisposisi = $this->model->get_disposisi_masuk_last($id);
            
            if($dataDisposisi) {
                $lastLevel = (int) $dataDisposisi->level;
                $catatan = $dataDisposisi->catatan;
                $disposisiBagian = $dataDisposisi->id_disposisi_bagian;
                #get level
                $paramLevel = [
                    'last_level' => $lastLevel+1,
                    'id_disposisi_bagian' => $disposisiBagian
                ];
                $level = $this->model2->getDisposisiLevelByLevel($paramLevel);                
            }
            #pertama kali disposisi
            else {
                $level = $this->model2->getDisposisiLevelFirst();
            }
            $dataSuratMasuk = $this->model->getById($id);
            echo json_encode($dataSuratMasuk);
            // $data = [
            //     'page' => $this->page,
            //     'title' => "Surat Masuk",
            //     'js' => ['surat-masuk'],
            //     'data' => $dataSuratMasuk, // data surat disposisi masuk
            //     'level' => $level,
            //     'disposisi' => $this->model->get_disposisi_masuk($id), //data disposisi level
            //     'lastProcess' => end($level),
            //     'distribusi' => ($dataSuratMasuk->distribusi == 0) ? false : $this->model->get_distribusiByIdDisposisi($dataDisposisi->id_disposisi_masuk),
            // ];
            
            //templateView("suratmasuk/disposisimasuk", $data);
        }
    }

    public function distribusipegawai() {
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $post = $this->input->post();
            $exp = explode(" (",$post['id_pegawai']);
            $namaPegawai = $exp[0];
            #jika nama pegawai ditemukan
            $rowPegawai = $this->model3->getByName($namaPegawai);
            if($rowPegawai) {
                $param = [
                    'id_disposisi_masuk' => $post['id'],
                    'id_pegawai' => $rowPegawai->id_user,
                    'nama' => $rowPegawai->nama,
                    'jabatan' => $rowPegawai->jabatan,
                    'telp' => $rowPegawai->no_telepon,
                    'tgl' => CURRENT_DATE,
                    'note' => $post['note'],
                ];
                $add = $this->model->add_distribusi($param);
                $updateSurat = $this->model->update_status_surat_distribusi($post['id_surat_masuk']);
                if($add > 0) {
                    $res['success'] = true;
                    $res['msg'] = "Berhasil mendistribusikan surat masuk";
                } else {
                    $res['success'] = false;
                    $res['msg'] = "Gagal mendistribusikan surat masuk";
                }                
            }
            else {
                $res['success'] = false;
                $res['msg'] = "Nama Pegawai Tidak ditemukan";
            }
            echo json_encode($res);

        }
    }




    
}
