<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Empresa extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		// PÁGINA EMPRESA
		$this->db->select('idPagina, dsTitulo, dsPagina, snGaleria, dsTitle, dsDescription, dsKeywords');
		$this->db->where('dsLink', 'empresa');
		$conteudos = $this->db->get('pagina')->result();
		// PÁGINA EMPRESA
		
		// PÁGINA EMPRESA GALERIA
		if ($conteudos[0]->snGaleria == 'S') {
			$this->db->select('dsImagem');
			$this->db->where('idPagina', $conteudos[0]->idPagina);
			$this->db->where('snAtivo', 'S');
			$this->db->order_by('sqOrdem', 'ASC');
			$galerias = $this->db->get('pagina_img')->result();
		} else {
			$galerias = '';
		}
		// PÁGINA EMPRESA GALERIA
		 
		$data = array(
				'dsTitle' 		=> ($conteudos[0]->dsTitle == '' ? $conteudos[0]->dsTitulo : $conteudos[0]->dsTitle).' - '.config('TITULO'),
				'dsDescription' => $conteudos[0]->dsDescription,
				'dsKeywords'    => $conteudos[0]->dsKeywords,
				'dsTitulo'		=> $conteudos[0]->dsTitulo,
				'dsPagina'		=> $conteudos[0]->dsPagina,
				'galerias'		=> $galerias,
		);
		
		$this->load->view('site/empresa', $data);
	}
}

/* End of file empresa.php */
/* Location: ./application/controllers/empresa.php */