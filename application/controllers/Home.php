<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		// PÁGINA HOME
		$this->db->select('dsTitle, dsDescription, dsKeywords');
		$this->db->where('dsLink', 'home');
		$conteudos = $this->db->get('pagina')->result();
		// PÁGINA HOME
		 
		// BANNERS
		$this->db->select('dsTitulo, dsImagem, dsLink');
		$this->db->where('snAtivo', 'S');
		$this->db->order_by('sqOrdem', 'ASC');
		$this->db->order_by('dsTitulo', 'ASC');
		$banners = $this->db->get('banner')->result();
		// BANNERS
		
		$data = array(
				'dsTitle' 				=> ($conteudos[0]->dsTitle == '' ? config('TITULO') : $conteudos[0]->dsTitle),
				'dsDescription' 		=> $conteudos[0]->dsDescription,
				'dsKeywords'			=> $conteudos[0]->dsKeywords,
				'banners'				=> $banners,
		);
		
		$this->load->view('site/home', $data);
	}

	public function enviar()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		// $this->form_validation->set_rules('dsNome', 'Seu nome', 'required');
		$this->form_validation->set_rules('dsEmail', 'Seu e-mail', 'required|valid_email');

		if ($this->form_validation->run() == false)
		{
			$data = array(
					'state'	=> 'error',
					'msg'	=> 'Preencha corretamente o formulário',
			);
			
			echo json_encode($data);
		}
		else
		{
			$this->db->select('idCadastro');
			$this->db->where('dsEmail', $this->input->post('dsEmail'));
			$newsletters = $this->db->get('newsletter');
			
			if ($newsletters->num_rows() == 0)
			{
				$dados = array(
						'dsNome'		=> $this->input->post('dsNome'),
						'dsEmail'		=> $this->input->post('dsEmail'),
						'dtCadastro'	=> date('Y-m-d H:i:s'),
						'idGrupo'   	=> '2',
				);

				$data = array(
						'state'	=> 'success',
						'msg'	=> 'Cadastro realizado com sucesso',
				);

				$this->db->insert('newsletter', $dados);

				echo json_encode($data);
				
			}
			else
			{
				$dados = array(
						'idGrupo'   => '2',
				);

				$this->db->where('dsEmail', $this->input->post('dsEmail'));
				$this->db->update('newsletter', $dados);

				$data = array(
						'state'	=> 'success',
						'msg'	=> 'Cadastro realizado com sucesso',
				);

				echo json_encode($data);
			}   
		}
		exit;
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */