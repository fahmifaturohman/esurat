<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PimpinanModel extends CI_Model
{
    private $_table = "`m_struktur`";
    private $_table2 = "`m_pegawai`";
    public $id_struktur;
    public $bagian;
    public $parent;
    public $type;
    public $id_pegawai;
    public $note;
    public $id_profile;
    public $deleted;


    public function rules() {
        return [
            [
                'field' =>  'bagian',
                'label' => 'bagian',
                'rules' => 'required'
            ],
            [
                'field' =>  'parent',
                'label' => 'parent',
                'rules' => 'required'
            ],
        ];
    }

    public function getAll() {
        return $this->db
                ->select('
                    a.id_struktur,
                    a.bagian,
                    a.parent,
                    a.note AS catatan,
                    a.id_pegawai AS pegawai,
                    b.id AS id_user,
                    b.nama,
                    b.username,
                    b.no_hp AS no_telepon
                ')
                ->from('ptaband2_spt.m_struktur a')
                ->join('siger2.users b', 'a.id_pegawai = b.id', 'left')
                ->where('a.deleted', 0)
                ->where('a.type', 'one')
                ->where('a.id_profile', ID_INSTANSI)
                ->order_by('a.id_struktur', 'ASC')
                ->get()
                ->result();
    }

    public function getParent() {
        $this->db->from($this->_table.' a');
        $this->db->select('a.id_struktur, a.bagian, a.parent, a.note');
        $this->db->where(['a.deleted' => 0, 'a.type' => 'one', 'a.id_profile' => ID_INSTANSI]);
        $this->db->order_by("a.id_struktur", "ASC");
        $query = $this->db->get(); 
        return $query->result();
    }

    public function getById($id) {
        return $this->db
            ->select('
                a.id_struktur,
                a.bagian,
                a.parent,
                a.note AS catatan,
                a.id_pegawai AS pegawai,
                b.id AS id_user,
                b.nama,
                b.username,
                b.no_hp AS no_telepon
            ')
            ->from('ptaband2_spt.m_struktur a')
            ->join('siger2.users b', 'a.id_pegawai = b.id', 'left')
            ->where('a.id_struktur', (int)$id)
            ->where('a.deleted', 0)
            ->where('a.type', 'one')
            ->where('a.id_profile', ID_INSTANSI)
            ->order_by('a.id_struktur', 'ASC')
            ->get()
            ->row();
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

    public function updateData($id, $param) {
        $this->db->where('id_struktur', $id);
        $this->db->update($this->_table, $param);
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

    //pencarian
    public function getJabatan($name) {
        $this->db->from('m_struktur');
        $this->db->like('bagian', $name);
        $this->db->where(['deleted' => 0, 'id_profile' => ID_INSTANSI]);
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result(); 
    }

   

    

}
