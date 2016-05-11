<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {
	
	var $tabela	= '';
	var $pagina	= 'inicio';
	var $pasta	= '';
	var $titulo	= 'Painel de Controle';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('painel');
		
		if ( ! $this->session->userdata('painel_logado'))
		{
			redirect(base_url('painel/login'));
			exit();
		}
	}

	public function index()
	{		
		$data	= array(
				'titulo' => $this->titulo,
		);
		
		$this->load->view('painel/'. $this->pagina .'/inicio', $data);
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/painel/inicio.php */