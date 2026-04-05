<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SuratMasukModel extends CI_Model
{
    private $_table = "`tb_surat_masuk`";
    public $no_surat;
    public $tgl_surat;
    public $tanggal_terima;
    public $asal_surat;
    public $sifat_surat;
    public $perihal;
    public $no_agenda;
    public $file_surat;
    public $status;
    public $tujuan;
    public $kode_surat;
    public $indeks;
    public $disposisi;
    public $tahun;
    public $deleted;


    public function rules() {
        return [
            [
                'field' =>  'kode_agenda',
                'label' => 'kode_agenda',
                'rules' => 'required'
            ],
        ];
    }

    public function getAll() {
        $sql = "SELECT 
                c.*,
                d.`id_asal_tujuan`, d.`asal_tujuan`, 
                a.`id_struktur`, a.`bagian`, a.`parent`, a.`note` catatan, a.`id_pegawai` pegawai,
                b.`id` id_user, b.`nama`, b.`username`, b.`no_telepon`
            FROM `tb_surat_masuk` c
            LEFT JOIN `m_struktur` a ON a.`id_struktur` = c.`tujuan`
            LEFT JOIN `sistemcuti`.`tbl_user` b ON a.`id_pegawai` = b.`id`
            LEFT JOIN `tb_asal_tujuan` d ON c.`asal_surat` = d.`id_asal_tujuan`
            WHERE c.`deleted` = 0 AND c.`tahun` = ".CURRENT_YEAR." AND a.`id_profile` = ".ID_INSTANSI."
            ORDER BY c.`id` DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }    

    public function getById($id) {
        $sql = "SELECT 
                c.*,
                d.`id_asal_tujuan`, d.`asal_tujuan`, 
                a.`id_struktur`, a.`bagian`, a.`parent`, a.`note` catatan, a.`id_pegawai` pegawai,
                b.`id_user` id_user, b.`nama`, b.`username`, b.`no_telepon`
            FROM `tb_surat_masuk` c
            LEFT JOIN `m_struktur` a ON a.`id_struktur` = c.`tujuan`
            LEFT JOIN `sistemcuti`.`tbl_user` b ON a.`id_pegawai` = b.`id_user`
            LEFT JOIN `tb_asal_tujuan` d ON c.`asal_surat` = d.`id_asal_tujuan`
            WHERE c.`id` = ".$id." AND c.`deleted` = 0 AND c.`tahun` = ".CURRENT_YEAR." AND a.`id_profile` = ".ID_INSTANSI."";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function getLastSuratMasuk() {
        $this->db->from($this->_table);
        $this->db->select('*');
        $this->db->where(['tahun' => CURRENT_YEAR]);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function checkNoAgenda($year) {
        $this->db->from($this->_table);
        $this->db->select('no_agenda');
        $this->db->where(['tahun' => $year]);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function getNoAgenda($no, $year) {
        $this->db->from($this->_table);
        $this->db->select('*');
        $this->db->where(['tahun' => $year, 'no_agenda' => $no]);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function save() {
        $post = $this->input->post();
        $this->no_surat = $post['nomor_surat'];
        $this->tgl_surat = date('Y-m-d', strtotime($post['tanggal_surat']));
        $this->tanggal_terima = date('Y-m-d');
        $this->asal_surat = $post['id_asal'];
        $this->sifat_surat = $post['sifat_surat'];
        $this->perihal = $post['note'];
        $this->no_agenda = $post['kode_agenda'];
        $this->file_surat = NULL;
        $this->status = 0;
        $this->tujuan = $post['id_tujuan'];
        $this->kode_surat = 0;
        $this->indeks = 1;
        $this->disposisi = 0;
        $this->tahun = my_filter_year();
        $this->deleted = 0;
        return $this->db->insert($this->_table, $this);
    }

    public function save_surat_rhs() {
        $post = $this->input->post();
        $this->no_surat = '-';
        $this->tgl_surat = date('Y-m-d');
        $this->tanggal_terima = date('Y-m-d');
        $this->asal_surat = $post['id_asal'];
        $this->sifat_surat = $post['sifat_surat'];
        $this->perihal = 'surat rahasia';
        $this->no_agenda = $post['kode_agenda'];
        $this->file_surat = NULL;
        $this->status = 0;
        $this->tujuan = $post['id_tujuan'];
        $this->kode_surat = 0;
        $this->indeks = '-';
        $this->disposisi = 0;
        $this->tahun = my_filter_year();
        $this->deleted = 0;
        return $this->db->insert($this->_table, $this);
    }

    
    
    


    // public function save($id_pegawai = "", $parent = "") {
    //     $post = $this->input->post();
    //     $this->bagian = $post['bagian'];
    //     $this->parent = $parent;
    //     $this->deleted = 0;
    //     $this->type = 'one';
    //     $this->id_pegawai = $id_pegawai;
    //     $this->note =$post['note'];
    //     $this->id_profile = ID_INSTANSI;
    //     $this->db->insert($this->_table, $this);
    //     return $this->db->affected_rows();
    // }

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
