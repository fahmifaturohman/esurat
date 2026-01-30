<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DisposisiModel extends CI_Model
{
     
    public function getDisposisiLevel() {
        $sql = "SELECT
                a.id_disposisi_level, a.id_disposisi_bagian `id_bagian`, b.disposisi_bagian `bagian`, 
                a.id_struktur, c.bagian `pimpinan`,
                a.level, a.catatan
                FROM m_disposisi_level a
                LEFT JOIN m_disposisi_bagian b ON a.id_disposisi_bagian = b.id_disposisi_bagian
                LEFT JOIN m_struktur c ON a.id_struktur = c.id_struktur
                WHERE a.deleted = 0 
                ORDER BY a.id_disposisi_bagian , a.level";
        $query = $this->db->query($sql); 
        return $query->result();
    }

    public function getDisposisiLevelFirst() {
        $sql = "SELECT a.id_disposisi_level, a.id_disposisi_bagian `id_bagian`, b.disposisi_bagian `pimpinan`, a.id_struktur, c.bagian `pimpinan1`, a.level, a.catatan 
                FROM m_disposisi_level a 
                LEFT JOIN m_disposisi_bagian b ON a.id_disposisi_bagian = b.id_disposisi_bagian 
                LEFT JOIN m_struktur c ON a.id_struktur = c.id_struktur 
                WHERE a.deleted = 0 AND a.level = 1 
                ORDER BY a.id_disposisi_bagian , a.level";
        $query = $this->db->query($sql); 
        return $query->result();
    }

    public function getDisposisiLevelByLevel($data) {
        $sql = "SELECT
            a.id_disposisi_level, a.id_disposisi_bagian `id_bagian`, b.disposisi_bagian `bagian`, 
            a.id_struktur, c.bagian `pimpinan`,
            a.level, a.catatan
            FROM m_disposisi_level a
            LEFT JOIN m_disposisi_bagian b ON a.id_disposisi_bagian = b.id_disposisi_bagian
            LEFT JOIN m_struktur c ON a.id_struktur = c.id_struktur
            WHERE a.deleted = 0 AND a.id_disposisi_bagian = ".$data['id_disposisi_bagian']." AND a.level = ".$data['last_level']."
            ORDER BY a.id_struktur DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getDisposisiLevelbyId($id) {
        $sql = "SELECT 
        a.*,
        b.bagian, b.id_pegawai, b.note,
        c.id id_user, c.nama, c.username `nip`, c.tempat_lahir, c.tgl_lahir, c.pangkat, c.golongan, c.jabatan, c.no_telepon
        FROM m_disposisi_level a
        LEFT JOIN m_struktur b ON a.id_struktur = b.id_struktur
        LEFT JOIN sistemcuti.tbl_user c ON b.id_pegawai = c.id
        WHERE a.id_disposisi_level = ".$id." 
        LIMIT 1";
        $query = $this->db->query($sql); 
        return $query->row();
    }



   

    

}
