<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiSipecutModel extends CI_Model
{
    private $db2;
    private $_table = "`tbl_user`";
    public $id_user;
    public $nama;
    public $username;
    public $no_telepon;
    public $status;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db2', TRUE);
        isLogin();
    }

    public function rules() {
        return [
            [
                'field' =>  'nama',
                'label' => 'nama',
                'rules' => 'required'
            ],
            [
                'field' =>  'username',
                'label' => 'username',
                'rules' => 'required'
            ],
            [
                'field' =>  'no_telepon',
                'label' => 'no_telepon',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll() {
        $this->db2->from($this->_table);
        $this->db2->select('id id_user, nama, username, tempat_lahir, tgl_lahir, tgl_jadi_pegawai, pangkat, golongan, jabatan, no_telepon, unit_kerja, role_id, status');
        $this->db2->where(['status' => 1, 'unit_kerja' => NAMA_INSTANSI]);
        $this->db2->where_not_in('jabatan', 'PPNPN');
        $query = $this->db2->get(); 
        return $query->result();
    }

    public function getById($id) {
       return $this->db2->get_where($this->_table, ['id' => $id, 'status' => 0])->row();
    }

    #search pegawai
    public function getLikeName($name) {
        $this->db2->from($this->_table);
        $this->db2->like('nama', $name);
        $this->db2->where(['status' => 1, 'unit_kerja' => NAMA_INSTANSI]);
        $this->db2->limit(3);
        $query = $this->db2->get();
        return $query->result(); 
    }
    public function getName($name) {
        $this->db2->from($this->_table);
        $this->db2->where(['nama'=>$name, 'status' => 1, 'unit_kerja' => NAMA_INSTANSI]);
        $this->db2->limit(3);
        $query = $this->db2->get();
        return $query->row(); 
    }
    
    #cari semua pegawai sewilayah pta
    public function getLikeNameAll($name) {
        $this->db2->from($this->_table);
        $this->db2->like('nama', $name);
        $this->db2->where(['status' => 1]);
        $this->db2->limit(3);
        $query = $this->db2->get();
        return $query->result(); 
    }
    public function getNameAll($name) {
        $this->db2->from($this->_table);
        $this->db2->where(['nama'=>$name, 'status' => 1]);
        $this->db2->limit(3);
        $query = $this->db2->get();
        return $query->row(); 
    }
    
    public function getLikeNameJabatan($name) {
        $sql = "SELECT a.* FROM  sistemcuti.`tbl_user` a WHERE (a.nama LIKE  '%".$name."%' OR a.jabatan LIKE '%".$name."%') AND ( a.status = 1 AND a.unit_kerja =  '".NAMA_INSTANSI."') LIMIT 5";
        $query = $this->db->query($sql); 
        return $query->result();
    }

    #validasi pegawai 
    public function getByName($name) {
        return $this->db2->get_where($this->_table, ['nama' => $name, 'status' => 1])->row();
    }

    public function updateStatus($post) {
        $this->db2->set('status', $post['status']);
        $this->db2->where('id', $post['id']);
        $this->db2->update($this->_table);
        return $this->db2->affected_rows();
    }




    #PPNPN
    public function getAllPpnpn() {
        $this->db2->from($this->_table);
        $this->db2->select('id id_user, nama, username, tempat_lahir, tgl_lahir, tgl_jadi_pegawai, pangkat, golongan, jabatan, no_telepon, unit_kerja, role_id, status');
        $this->db2->where(['status' => 1, 'unit_kerja' => NAMA_INSTANSI, 'jabatan' => 'PPNPN']);
        $query = $this->db2->get(); 
        return $query->result();
    }

    public function getByIdPpnpn($id) {
       return $this->db2->get_where($this->_table, ['id' => $id, 'status' => 0, 'jabatan' => 'PPNPN'])->row();
    }



}
