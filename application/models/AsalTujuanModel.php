<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AsalTujuanModel extends CI_Model
{
    private $_table = "tb_asal_tujuan`";
    public $asal_tujuan;
    public $alamat;
    public $deleted;


    public function rules() {
        return [
            [
                'field' =>  'asal_tujuan',
                'label' => 'kode',
                'rules' => 'required'
            ],
        ];
    }

    public function getAll() {
        $this->db->from($this->_table);
        $this->db->where(['deleted' => 0]);
        $this->db->order_by("id_asal_tujuan", "desc");
        $query = $this->db->get(); 
        return $query->result();
    }

    public function getById($id) {
       return $this->db->get_where($this->_table, ['id_asal_tujuan' => $id])->row();
    }

    public function getName($name) {
        return $this->db->get_where($this->_table, ['asal_tujuan' => $name])->row();
    }

    #searh by tujuan
    public function getLikeTujuan($name) {
        $this->db->from($this->_table);
        $this->db->like('asal_tujuan', $name);
        $this->db->where(['deleted' => 0]);
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result(); 
    }

    public function save() {
        $post = $this->input->post();
        $this->asal_tujuan = $post["asal_tujuan"];
        $this->alamat = $post["alamat"];
        $this->deleted = 0;
        return $this->db->insert($this->_table, $this);
    }

    public function update() {
        $post = $this->input->post();
        $this->id_asal_tujuan = $post["id"];
        $this->asal_tujuan = $post["asal_tujuan"];
        $this->alamat = $post['alamat'];
        return $this->db->update($this->_table, $this, ['id_asal_tujuan' => $post['id']]);
    }

    public function delete() {
        $post = $this->input->post();
        $this->db->set('deleted', 1);
        $this->db->where('id_asal_tujuan', $post['id']);
        return $this->db->update($this->_table);
    }

    public function hardDelete($id) {
        $this->db->delete($this->_table, ['id_asal_tujuan' => $id, 'deleted' => 1]);
        return $this->db->affected_rows();
    }

    

    #pengecekan asal tujuan, sudah ada atau belum
    public function insertOrUpdate_asalTujuan($data) {
        $row = $this->db->get_where($this->_table, ['asal_tujuan' => $data['asal_tujuan']])->row();
        if($row != null) {
            $this->db->set('alamat', $data['alamat']);
            $this->db->where('id_asal_tujuan', $row->id_asal_tujuan);
            return $this->db->update($this->_table);
        }
        else {
            $this->db->insert($this->_table, $data);
            return $this->db->insert_id();
        }
    }

}
