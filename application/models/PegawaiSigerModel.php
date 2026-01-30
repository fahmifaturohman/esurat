<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiSigerModel extends CI_Model
{
    private $db3;
    private $_table = "`users`";
    public $id_user;
    public $nama;
    public $username;
    public $no_telepon;
    public $status;

    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('db3', TRUE);
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

    public function getAll($satker) {
        $this->db3->from($this->_table);
        $this->db3->select('*');
        if($satker != "") $this->db3->where('nama_satker', $satker);
        $this->db3->where_not_in('jabatan', 'PPNPN');
        $query = $this->db3->get(); 
        return $query->result();
    }

    public function getById($id) {
       return $this->db3->get_where($this->_table, ['id' => $id, 'status' => 0])->row();
    }

    #search pegawai
    public function getLikeName($name) {
        $this->db3->from($this->_table);
        $this->db3->like('nama', $name);
        $this->db3->where(['active' => 1, 'nama_satker' => NAMA_INSTANSI]);
        $this->db3->limit(3);
        $query = $this->db3->get();
        return $query->result(); 
    }

    public function getName($name) {
        $this->db3->from($this->_table);
        $this->db3->where(['nama'=>$name, 'active' => 1, 'nama_satker' => NAMA_INSTANSI]);
        $this->db3->limit(3);
        $query = $this->db3->get();
        return $query->row(); 
    }
    
    #cari semua pegawai sewilayah pta
    public function getLikeNameAll($name) {
        $this->db3->from($this->_table);
        $this->db3->like('nama', $name);
        $this->db3->where(['active' => 1]);
        $this->db3->limit(5);
        $query = $this->db3->get();
        return $query->result(); 
    }

    public function getNameAll($name) {
        $this->db3->from($this->_table);
        $this->db3->where(['nama'=>$name, 'active' => 1]);
        $this->db3->limit(3);
        $query = $this->db3->get();
        return $query->row(); 
    }
    
    public function getLikeNameJabatan($name) {
        return $this->db
            ->from('siger2.users a')
            ->group_start()
                ->like('a.nama', $name)
                ->or_like('a.jabatan', $name)
            ->group_end()
            ->where('a.active', 1)
            ->where('a.nama_satker', NAMA_INSTANSI)
            ->limit(5)
            ->get()
            ->result();
    }

    #validasi pegawai 
    public function getByName($name) {
        return $this->db3->get_where($this->_table, ['nama' => $name, 'active' => 1])->row();
    }

    public function updateStatus($post) {
        $this->db3->set('status', $post['status']);
        $this->db3->where('id', $post['id']);
        $this->db3->update($this->_table);
        return $this->db3->affected_rows();
    }
}
