<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    private $_table = "`tb_user`";
    public $username;
    public $password;


    public function __construct() {
        parent::__construct();
        $this->db2 = $this->load->database('db2', TRUE);
    }

    public function rules() {
        return [
            [
                'field' =>  'username',
                'label' => 'username',
                'rules' => 'required'
            ],
            [
                'field' =>  'password',
                'label' => 'password',
                'rules' => 'required'
            ],
        ];
    }

    
    public function auth_esurat($data) {
        $this->db->from($this->_table);
        $this->db->select('`id`, `username`, `level`, `gambar`, gambar, nama, kdeselon, status');
        $this->db->where(['username'  => $data['username'], 'password' => md5($data['password']), 'deleted' => 0]);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }    
}
