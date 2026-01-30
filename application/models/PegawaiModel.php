<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiModel extends CI_Model
{
    private $_table = "`m_pegawai`";
    private $_table2 = "`m_struktur`";
    private $_tablePegawai = "`pegawai`";
    public $id_pegawai;
    public $nama_pegawai;
    public $nip;
    public $telp;
    public $id_jabatan;
    public $deleted;

    public function rules() {
        return [
            [
                'field' =>  'nama_pegawai',
                'label' => 'nama_pegawai',
                'rules' => 'required'
            ],
            [
                'field' =>  'nip',
                'label' => 'nip',
                'rules' => 'required'
            ],
            [
                'field' =>  'telp',
                'label' => 'telp',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll() {
        $this->db->from($this->_table.' a');
        $this->db->select('a.id_pegawai, a.nama_pegawai, a.nip, a.telp, b.id_struktur, b.bagian, b.parent, b.note catatan, b.id_pegawai pegawai');
        $this->db->join($this->_table2.' b', 'a.id_jabatan = b.id_struktur', 'left');
        $this->db->where(['a.deleted' => 0]);
        $this->db->order_by("a.id_pegawai", "DESC");
        $query = $this->db->get(); 
        return $query->result();
    }

    public function getById($id) {
       return $this->db->get_where($this->_table, ['id_pegawai' => $id, 'deleted' => 0])->row();
    }

    #search pegawai
    public function getLikeName($name) {
        $this->db->from($this->_table);
        $this->db->like('nama_pegawai', $name);
        $this->db->where(['deleted' => 0]);
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result(); 
    }

    #validasi pegawai 
    public function getByName($name) {
        return $this->db->get_where($this->_table, ['nama_pegawai' => $name, 'deleted' => 0])->row();
    }

    public function save() {
        $post = $this->input->post();
        $this->asal_tujuan = $post["asal_tujuan"];
        $this->deleted = 0;
        return $this->db->insert($this->_table, $this);
    }

    public function update() {
        $post = $this->input->post();
        $this->id_asal_tujuan = $post["id"];
        $this->asal_tujuan = $post["asal_tujuan"];
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

    public function updateOrCreate($data)
    {
        $existingRecord = $this->db->get_where($this->_tablePegawai, ['nip' => $data['nip']])->row();
        if ($existingRecord) {
            $this->db->where('nip', $data['nip'])->set([
                'id_pegawai' => $data['id_pegawai'],
                'nama' => $data['nama'],
                'email' => $data['email'],
                'jabatan' => $data['jabatan'],
                'kode_satker' => $data['kode_satker'],
                'nama_satker' => $data['nama_satker'],
                'id_jabatan' => $data['id_jabatan'],
                'id_posisi_jabatan' => $data['id_posisi_jabatan'],
                'golongan' => $data['golongan'],
                'nama_golongan' => $data['nama_golongan'],
                'email_pegawai' => $data['email_pegawai'],
                'no_hp' => $data['no_hp'],
                'foto' => $data['foto'],
                'nama_posisi_jabatan' => $data['nama_posisi_jabatan'],
                'active' => $data['active'],
            ])->update($this->_tablePegawai);
            return $this->db->affected_rows();
        } else {
            $this->db->insert($this->_tablePegawai, $data);
            return $this->db->insert_id();
        }
    }


}
