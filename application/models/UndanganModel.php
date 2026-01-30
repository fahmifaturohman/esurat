<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UndanganModel extends CI_Model
{
  
    public function getData() {
        $this->db->from('undangan');
        $this->db->select('*');
        $this->db->where(['deleted' => 0]);
        $this->db->order_by('id_undangan', 'DESC');
        return $this->db->get()->result();
    }

    public function getDataId($id) {
        $this->db->from('undangan');
        $this->db->select('*');
        $this->db->where(['deleted' => 0, 'id_undangan' => $id]);
        $this->db->order_by('id_undangan', 'DESC');
        return $this->db->get()->result();
    }

    public function insertData($param) {
        $this->db->insert('undangan', $param);
        return $this->db->insert_id();
    }

    public function updateData($id, $param) {
        $this->db->where('id_undangan', $id);
        $this->db->update('undangan', $param);
        return $this->db->affected_rows();
    }

    public function deleteData($id) {
        $this->db->set('deleted', 1);
        $this->db->where('id_undangan', $id);
        $this->db->update('undangan');
        return $this->db->affected_rows();
    }





   

    

}
