<?php defined('BASEPATH') OR exit('No direct script access allowed');

class IzinKeluarModel extends CI_Model
{
    public function rules() {
        return [
            [
                'field' =>  'keperluan',
                'label' => 'keperluan',
                'rules' => 'required'
            ],
        ];
    }

    public function getData($year = CURRENT_YEAR) {
        $this->db->from('view_izin_keluar_kantor');
        $this->db->where('YEAR(created)', $year);
        $this->db->where('deleted', 0);
        $this->db->order_by('id_izin', 'DESC');
        return $this->db->get()->result();
    }

    public function getRow($id) {
        return $this->db->get_where('view_izin_keluar_kantor', ['id_izin' => $id, 'deleted' => 0])->row();
    }

    public function insertData($param) {
        $this->db->insert('izin_keluar', $param);
        return $this->db->insert_id();
    }

    public function insertDataDetail($param) {
        $this->db->insert('izin_keluar_detail', $param);
        return $this->db->insert_id();
    }

    public function updateData($id, $param) {
        $this->db->where('id_izin', $id);
        $this->db->update('izin_keluar', $param);
        return $this->db->affected_rows();
    }

    public function updateDataDetail($id, $param) {
        $this->db->where('id_izin_keluar_detail', $id);
        $this->db->update('izin_keluar_detail', $param);
        return $this->db->affected_rows();
    }

    public function deleteData($id) {
        $this->db->set('deleted', 1);
        $this->db->where('id_izin', $id);
        $this->db->update('izin_keluar');
        return $this->db->affected_rows();
    }

    public function deleteDataDetail($id) {
        $this->db->set('deleted', 1);
        $this->db->where('id_izin_keluar_detail', $id);
        $this->db->update('izin_keluar_detail');
        return $this->db->affected_rows();
    }














   

    

}
