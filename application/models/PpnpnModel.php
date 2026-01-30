<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PpnpnModel extends CI_Model
{
  
    public function getData() {
        $this->db->from('`view_ppnpn`');
        return $this->db->get()->result();
    }

    public function getDataId($id) {
        $this->db->from('view_ppnpn');
        $this->db->where(['deleted' => 0, 'id' => $id]);
        return $this->db->get()->row();
    }

    public function insertData($param) {
        $this->db->insert('m_ppnpn', $param);
        return $this->db->insert_id();
    }

    public function updateData($id, $param) {
        $this->db->where('id', $id);
        $this->db->update('m_ppnpn', $param);
        return $this->db->affected_rows();
    }

    public function deleteData($id) {
        $this->db->set('deleted', 1);
        $this->db->where('id', $id);
        $this->db->update('m_ppnpn');
        return $this->db->affected_rows();
    }


    //pencarian
    public function getLikeNameAll($name) {
        $this->db->from("m_ppnpn");
        $this->db->like('nama', $name);
        $this->db->where(['deleted' => 0]);
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result(); 
    }

    public function getNameAll($name) {
        $this->db->from('m_ppnpn');
        $this->db->where(['nama'=>$name, 'deleted' => 0]);
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->row(); 
    }





   

    

}
