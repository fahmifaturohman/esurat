<?php

use phpDocumentor\Reflection\Types\Parent_;

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    private $page;
    
    public function __construct()
    {
        parent::__construct();
        $this->page = "login";
        $this->load->model("LoginModel", "model");
    }

    public function index() 
    {
        isLogut();
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $validation = $this->form_validation;
            $validation->set_rules($this->model->rules());

            if ($validation->run()) {
                $post = $this->input->post();
                $param = [
                    'username' => htmlspecialchars($post['username']),
                    'password' => htmlspecialchars($post['password'])
                ];                
                #user e-surat
                $auth_esurat = $this->model->auth_esurat($param);
                if($auth_esurat) {
                    $this->session->set_userdata([
                        MY_SESSION_DATA => $auth_esurat, 
                        MY_SESSION_BY => "esurat",
                        MY_SESSION_LOGGED => true
                    ]);
                    $res['success'] = true;
                    $res['msg'] = "berhasil login";
                }
                else {
                    $res['success'] = false;
                    $res['msg'] = "username atau password salah";
                }
            }
            else {
                $res['success'] = false;
                $res['msg'] = "usename dan password tidak boleh kosong";               
            }
            echo json_encode($res);
        }
        else {
            $data = [
                'page' => $this->page,
                'title' => "Login",
                'data' => [],
                'js' => ['login'],
            ];
            $this->load->view('login/login', $data);
        }
    }
  
    public function out() {
        isLogin();
        $this->session->unset_userdata(MY_SESSION_DATA);
        $this->session->unset_userdata(MY_SESSION_LOGGED);
        return redirect()->to(base_url());
    }
    
}
