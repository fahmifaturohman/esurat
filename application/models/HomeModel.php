<?php defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model
{

    public function countSpt($tipe ="") {
        $this->db->from('`spt`');
        $this->db->where(['spt_tipe' => $tipe, 'YEAR(tgl)' => CURRENT_YEAR, 'deleted' => 0]);
        return $this->db->get()->num_rows();
    }

    public function countSptAll() {
        $this->db->from('`spt`');
        $this->db->where(['YEAR(tgl)' => CURRENT_YEAR, 'deleted' => 0]);
        return $this->db->get()->num_rows();
    }

    public function getIzinKeluarKantor($year = CURRENT_YEAR) {
        $this->db->from('view_izin_keluar_kantor');
        $this->db->where('YEAR(created)', $year);
        $this->db->where('deleted', 0);
        $this->db->order_by('id_izin', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
    }

    public function getSpt() {
        // $this->db->from('view_spt');
        // $this->db->where(['deleted' => 0, 'YEAR(tgl)' => CURRENT_YEAR]);
        // $this->db->order_by('id_spt', 'DESC');
        // $this->db->limit(5);
        // return $this->db->get()->result();
        return 1;
    }

  





   

    

}
