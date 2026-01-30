<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KlasifikasiModel extends CI_Model
{
    private $_table = "ref_klasifikasi";
    public $kode;
    public $nama;
    public $uraian;
    public $deleted;


    public function rules() {
        return [
            [
                'field' =>  'kode',
                'label' => 'kode',
                'rules' => 'required'
            ],
            [
                'field' =>  'nama',
                'label' => 'nama',
                'rules' => 'required'
            ],
            [
                'field' =>  'uraian',
                'label' => 'uraian',
                'rules' => 'required'
            ],
        ];
    }

    public function getAll() {
        $this->db->from($this->_table);
        $this->db->where(['deleted' => 0]);
        $this->db->order_by("id", "desc");
        $query = $this->db->get(); 
        return $query->result();
    }

    public function getById($id) {
       return $this->db->get_where($this->_table, ['id' => $id])->row();
    }
    #searh by nama and kode
    public function getLikeName($name) {
        $this->db->from($this->_table);
        $this->db->like('nama', $name);
        $this->db->or_like('kode', $name);
        $this->db->where(['deleted' => 0]);
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result(); 
    }

    public function save() {
        $post = $this->input->post();
        $this->kode = $post["kode"];
        $this->nama = $post["nama"];
        $this->uraian = $post["uraian"];
        $this->deleted = 0;
        return $this->db->insert($this->_table, $this);
    }

    public function update() {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->kode = $post["kode"];
        $this->nama = $post["nama"];
        $this->uraian = $post["uraian"];
        return $this->db->update($this->_table, $this, ['id' => $post['id']]);
    }

    public function delete() {
        $post = $this->input->post();
        $this->db->set('deleted', 1);
        $this->db->where('id', $post['id']);
        return $this->db->update($this->_table);
    }

    public function hardDelete($id) {
        return $this->db->delete($this->_table, ['id' => $id, 'deleted' => 1]);
    }

    



    #chek validation
    public function getKode() {
        $post = $this->input->post();
        $this->kode = $post['kode'];
        return $this->db->get_where($this->_table, ['kode' => $this->kode])->row();
    }

}
