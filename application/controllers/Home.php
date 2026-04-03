<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	private $page;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->page = "home";
		$this->load->model("HomeModel", "model");
		isLogin();
	}

    public function index() 
	{
		self::get_thang();
		$kegiatan = $this->model->countSpt("spt kegiatan");
		$plh = $this->model->countSpt("spt plh");
		$diklat = $this->model->countSpt("spt diklat");
		$spt =  $this->model->countSptAll();
		$data = [
			'page' => $this->page,
			'data' => [
				'spt_kegiatan' => $kegiatan,
				'spt_kegiatan_persen' => ($kegiatan == 0) ? '0':($kegiatan/$spt)*100,
				'spt_plh' => $plh,
				'spt_plh_persen' => ($plh == 0) ? '0':($plh/$spt)*100,
				'spt_diklat' => $diklat,
				'spt_diklat_persen' => ($diklat == 0) ? '0':($diklat/$spt)*100,
				'spt' => $spt,
				'izin' => $this->model->getIzinKeluarKantor(),
				'dataspt' => $this->model->getSpt(),
			]
		];
		templateView("home/home", $data);
	}

	public function set_thang(){

		$thang = $this->input->post("thang");
		$cookie= array(
           'name'   => MY_THANG,
           'value'  => my_crypt($thang),                            
           'expire' => 360000,                                                                              
           'secure' => TRUE
       );
	   $thangLabel = ($thang == 'all') ? "Tampikan Semua Data":'Tampilkan Data Tahun '.$thang; 
	   $cookie2= array(
           'name'   => MY_THANG_LABEL,
           'value'  => my_crypt($thangLabel),                            
           'expire' => 360000,                                                                              
           'secure' => TRUE
       );
		set_cookie($cookie);
		set_cookie($cookie2);
		echo json_encode(['success' => true, 'msg' => 'Tahun berhasil diubah']);

	}

	private function get_thang() {
		$thang = date('Y');
		if(empty($this->input->cookie(MY_THANG))) {
		$cookie= array(
           'name'   => MY_THANG,
           'value'  => my_crypt($thang),                            
           'expire' => 360000,                                                                              
           'secure' => TRUE
       );
	   $thangLabel = ($thang == 'all') ? "Tampilkan Semua Data":'Tampilkan Data Tahun '.$thang; 
	   $cookie2= array(
           'name'   => MY_THANG_LABEL,
           'value'  => my_crypt($thangLabel),                            
           'expire' => 360000,                                                                              
           'secure' => TRUE
       );
		set_cookie($cookie);
		set_cookie($cookie2);
	}

	}


}