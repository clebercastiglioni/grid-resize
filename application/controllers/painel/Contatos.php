<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contatos extends CI_Controller {
	
	var $tabela	= 'contato';
	var $pagina	= 'contatos';
	var $pasta	= 'contatos';
	var $titulo	= 'Mensagens';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('painel');
		$this->load->helper('date');
		
		if(!$this->session->userdata('painel_logado'))
		{			
			redirect(base_url('painel/login/?p=mensagens'));	
			exit();
		}
	}
	
	public function index()
	{
		if ($this->input->get('dsBusca')) {
			redirect(base_url('painel/contatos/busca/'. $this->input->get('dsBusca')));
			exit();
		} else
			$this->listar();
	}
	
	public function busca($dsBusca='',$id='',$de_paginacao=0)
	{
		$this->listar($de_paginacao,$dsBusca);
	}

	public function listar($de_paginacao=0,$id='',$dsBusca='')
	{
		$this->load->model('model_painel_mensagens');
		 
		$this->load->library(array('pagination'));
		 
		$de_paginacao = ( $de_paginacao < 0 || $de_paginacao == 1 ) ? 0 : (int) $de_paginacao;
		 
		$mensagens = $this->model_painel_mensagens->get_all($de_paginacao, $this->config->item('painel_registro_pagina'), $dsBusca);
		 
		$config['base_url'] 		= site_url('painel/contatos/pagina');
		$config['total_rows']		= $this->model_painel_mensagens->count_rows($dsBusca);
		$config['per_page']			= $this->config->item('painel_registro_pagina');
		$config['uri_segment']		= '4';
		
		$config['cur_tag_open'] 	= '<li style="margin:6px">';
		$config['cur_tag_close'] 	= '</li>';
		$config['prev_link']		= '<span style="margin:6px">Anterior</span>';
		$config['next_link']		= '<span style="margin:6px">Próxima</span>';
		 
		$this->pagination->initialize($config);
		$id = '';
		$data	= array(
				'titulo'	=> $this->titulo,
				'conteudos' => $mensagens,
				'id' 		=> $id,
				'paginacao'	=> $this->pagination->create_links(),
		);

		$this->load->view('painel/'. $this->pagina .'/list', $data);
	}
	
	public function adicionar()
	{		
		$data	= array(
			'titulo' 		=> $this->titulo,
			'acaoControl'	=> 'salvar',
			);
		$this->load->view('painel/'. $this->pagina .'/form', $data);
	}
	
	public function inbox($id=0)
	{
		$this->load->view('painel/'. $this->pagina .'/inbox');
	}
	
	public function editar($id=0)
	{
		$this->db->where('idContato', $id);
		
		$data	= array(
			'titulo' 		=> $this->titulo,
			'acaoControl'	=> 'alterar',
			'conteudos'		=> $this->db->get($this->tabela)->result(),
			);
		
		$this->load->view('painel/'. $this->pagina .'/form', $data);
	}
	
	public function excluir($id=0)
	{
		if ($this->input->post('idContato') != false) {
			$id = $this->input->post('idContato');
		}
		
		$this->db->where('idContato', $id);
		$this->db->delete($this->tabela);
		
		//redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function ativo()
	{
		$id = $this->input->post('idContato');

		$this->db->where('idContato', $id);
		$conteudos = $this->db->get($this->tabela)->result();

		if ($conteudos[0]->snLido == 'N')
		{
			$snLido = 'S';

			$data	= array(
				'snLido' 	=> $snLido,
			);

			$this->db->where('idContato', $id);
			$this->db->update($this->tabela, $data);
		}
	}
}

/* End of file contatos.php */
/* Location: ./application/controllers/painel/contatos.php */