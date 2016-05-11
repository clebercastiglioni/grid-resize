<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class erro404 extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index(){
		// BREADCRUMB
		$breadcrumbs = array(
			0	=> array(
				'name'	=> 'Home',
				'url'	=> base_url('')
			),
			1	=> array(
				'name'	=> 'Erro 404',
				'url'	=> base_url('404')
			),
		);
		// BREADCRUMB

		$data['breadcrumbs'] = $breadcrumbs;

		$this->load->view('site/common/_404', $data);
	}
}

/* End of file Erro404.php */
/* Location: ./application/controllers/Erro404.php */