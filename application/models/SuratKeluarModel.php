<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SuratKeluarModel extends CI_Model
{
    private $_table = "`tb_surat_keluar`";
    public $no_surat;
    public $tgl_surat;
    public $tanggal_keluar;
    public $kepada;
    public $sifat_surat;
    public $perihal;
    public $no_agenda;
    public $kode_surat;
    public $foto;
    public $tujuan;
    public $tahun;
    public $deleted;


    public function rules() {
        return [
            [
                'field' =>  'no_surat',
                'label' => 'no_surat',
                'rules' => 'required'
            ],
            [
                'field' =>  'tgl_surat',
                'label' => 'tgl_surat',
                'rules' => 'required'
            ],
        ];
    }

    public function getAll() {
        $this->db->from($this->_table.' a');
        $this->db->select('a.id, a.no_surat, a.tgl_surat, a.tanggal_keluar, a.kepada, a.sifat_surat, a.perihal, a.no_agenda, a.kode_surat, a.foto `file_surat`, a.status, a.distribusi,
        b.kode kode_klasifikasi, b.nama nama_klasifikasi, b.uraian uraian_klasifikasi, 
        c.id_asal_tujuan, c.asal_tujuan');
        $this->db->join('ref_klasifikasi b', 'a.kode_surat = b.id','left');
        $this->db->join('tb_asal_tujuan c', 'a.kepada = c.id_asal_tujuan','left');
        $this->db->where(['a.deleted' => 0, 'a.tahun' => CURRENT_YEAR]);
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
  
    public function getById($id) {
        $this->db->from($this->_table.' a');
        $this->db->select('a.id, a.no_surat, a.tgl_surat, a.tanggal_keluar, a.kepada, a.sifat_surat, a.perihal, a.no_agenda, a.kode_surat, a.foto `file_surat`, a.status, a.distribusi,
        b.kode kode_klasifikasi, b.nama nama_klasifikasi, b.uraian uraian_klasifikasi, 
        c.id_asal_tujuan, c.asal_tujuan');
        $this->db->join('ref_klasifikasi b', 'a.kode_surat = b.id','left');
        $this->db->join('tb_asal_tujuan c', 'a.kepada = c.id_asal_tujuan','left');
        $this->db->where(['a.deleted' => 0, 'a.tahun' => CURRENT_YEAR, 'a.id' => $id]);
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    #validasi input bagian
    public function getByName($name) {
        return $this->db->get_where($this->_table, ['bagian' => $name, 'deleted' => 0])->row();
    } 
    
    
    


    public function save($id_pegawai = "", $parent = "") {
        $post = $this->input->post();
        $this->bagian = $post['bagian'];
        $this->parent = $parent;
        $this->deleted = 0;
        $this->type = 'one';
        $this->id_pegawai = $id_pegawai;
        $this->note =$post['note'];
        $this->id_profile = ID_INSTANSI;
        $this->db->insert($this->_table, $this);
        return $this->db->affected_rows();
    }

    public function addNote() {
        $post = $this->input->post();
        $this->db->set('note', $post['note']);
        $this->db->where('id_struktur', $post['id']);
        $this->db->update($this->_table);
        return $this->db->affected_rows();
    }

    public function addPegawai($id_pegawai = "") {
        $post = $this->input->post();
        $this->db->set('id_pegawai', $id_pegawai);
        $this->db->set('note', $post['note']);  
        $this->db->where('id_struktur', $post['id']);      
        $this->db->update($this->_table);
        return $this->db->affected_rows();
    }

    public function update($id_pegawai = "", $parent = "") {
        $post = $this->input->post();
        $this->db->set('bagian', $post['bagian']);
        $this->db->set('parent', $parent);
        $this->db->set('id_pegawai', $id_pegawai);
        $this->db->set('note', $post['note']);  
        $this->db->where('id_struktur', $post['id']);      
        $this->db->update($this->_table);
        return $this->db->affected_rows();
    }

    public function update_status_surat($id) {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
        return $this->db->affected_rows();
    }

    public function update_status_surat_distribusi($id) {
        $this->db->set('distribusi', 1);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
        return $this->db->affected_rows();
    }

    public function delete() {
        $post = $this->input->post();
        $this->db->set('deleted', 1);
        $this->db->where('id_struktur', $post['id']);
        $this->db->update($this->_table);
        return $this->db->affected_rows();
    }

    public function hardDelete($id) {
        $this->db->delete($this->_table, ['id_struktur' => $id, 'deleted' => 1]);
        return $this->db->affected_rows();
    }






    /* 
    DISPOSISI MASUK
    */
    public function get_disposisi_masuk($id = "") {
        $this->db->from($this->_table.' a');
        $this->db->select('a.id, a.no_surat, a.tgl_surat, a.tanggal_terima, b.*');
        $this->db->join('tb_surat_masuk_disposisi b', 'a.id = b.id_surat', 'right');
        $this->db->where(['a.deleted' => 0, 'b.id_surat' => $id]);
        $this->db->order_by("b.id_disposisi_masuk", "DESC");
        $query = $this->db->get(); 
        return $query->result();
    }

    public function get_disposisi_masuk_last($id = "") {
        $this->db->from($this->_table.' a');
        $this->db->select('a.id, a.no_surat, a.tgl_surat, a.tanggal_terima, b.*, c.id_disposisi_bagian, c.level, c.catatan');
        $this->db->join('tb_surat_masuk_disposisi b', 'a.id = b.id_surat', 'right');
        $this->db->join('m_disposisi_level c', 'b.id_disposisi_level = c.id_disposisi_level', 'left');
        $this->db->where(['a.deleted' => 0, 'b.id_surat' => $id]);
        $this->db->order_by("b.id_disposisi_masuk", "DESC");
        $this->db->limit(1);
        $query = $this->db->get(); 
        return $query->row();
    }

    public function add_disposisi($param) {
        $this->db->insert('tb_surat_masuk_disposisi', $param);
        return $this->db->affected_rows();
    }

    public function get_distribusiByIdDisposisi($id) {
        $this->db->from('tb_surat_masuk_distribusi a');
        $this->db->select('a.id_distribusi, a.id_disposisi_masuk, a.tgl `tgl_distribusi`, a.nama `nama_pegawai`, a.jabatan `jabatan_pegawai`, a.telp `telp_pegawai`, a.note,
        b.id_disposisi_level, b.id_surat, b.id_struktur, b.bagian, b.nama `distribusi_oleh`, b.telp `distribusi_telp`,
        c.no_surat, c.tgl_surat, c.tanggal_terima, c.sifat_surat, c.no_agenda,c.file_surat');
        $this->db->join('tb_surat_masuk_disposisi b', 'a.id_disposisi_masuk = b.id_disposisi_masuk', 'left');
        $this->db->join('tb_surat_masuk c','b.id_surat = c.id','left');
        $this->db->where(['a.deleted' => 0, 'a.id_disposisi_masuk' => $id]);
        $this->db->order_by("a.id_distribusi", "DESC");
        $this->db->limit(1);
        $query = $this->db->get(); 
        return $query->row();


    }

    public function add_distribusi($param) {
        $this->db->insert('tb_surat_masuk_distribusi', $param);
        return $this->db->affected_rows();
    }    

}
