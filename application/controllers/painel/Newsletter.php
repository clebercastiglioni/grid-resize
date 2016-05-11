<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {
	
	var $tabela	= 'newsletter';
	var $pagina	= 'newsletter';
	var $pasta	= 'newsletter';
	var $titulo	= 'Newsletter';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('painel');
		$this->load->helper('date');
		
		if ( ! $this->session->userdata('painel_logado'))
		{
			redirect(base_url('painel/login'));
			exit();
		}
	}

	public function index()
	{
		$this->listar();
	}
	
	public function listar()
	{
		$this->db->select('newsletter.idCadastro as idCadastro, newsletter.dsNome as dsNome, newsletter.dsEmail as dsEmail, newsletter.dtCadastro as dtCadastro, newsletter.snAtivo as snAtivo, grupo.dsTitulo as dsGrupo');
		$this->db->from($this->tabela);
		$this->db->join('grupo', 'newsletter.idGrupo = grupo.idGrupo');
		$this->db->order_by('newsletter.dsNome', 'ASC');
		$this->db->order_by('newsletter.dsEmail', 'ASC');
		$conteudos = $this->db->get();
		 
		$data	= array(
				'titulo'	=> $this->titulo,
				'conteudos' => $conteudos,
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
	
	public function salvar()
	{
		$data	= array(
				'idGrupo' 		=> '2',
				'dsNome'		=> $this->input->post('dsNome'),
				'dsEmail' 		=> $this->input->post('dsEmail'),
				'dtCadastro' 	=> date('Y-m-d H:i:s'),
				'snAtivo' 		=> $this->input->post('snAtivo'),
		);
		
		$this->db->insert($this->tabela, $data);
		
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function editar($id)
	{
		$this->db->where('idCadastro', $id);
		
		$data	= array(
				'titulo' 		=> $this->titulo,
				'acaoControl'	=> 'alterar',
				'conteudos'		=> $this->db->get($this->tabela)->result(),
		);
		
		$this->load->view('painel/'. $this->pagina .'/form', $data);
	}
	
	public function alterar()
	{
		$id = $this->input->post('idCadastro');

		$data	= array(
				'dsNome' 		=> $this->input->post('dsNome'),
				'dsEmail' 		=> $this->input->post('dsEmail'),
				'snAtivo' 		=> $this->input->post('snAtivo'),
		);

		$this->db->where('idCadastro', $id);
		$this->db->update($this->tabela, $data);
		
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function excluir($id)
	{
		if ($this->input->post('idCadastro') != false) {
			$id = $this->input->post('idCadastro');
		}
		
		$this->db->where('idCadastro', $id);
		$this->db->delete($this->tabela);
		
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function ativo()
	{
		$id = $this->input->post('idCadastro');
	
		$this->db->where('idCadastro',$id);
		$conteudos = $this->db->get($this->tabela)->result();
	
		if ($conteudos[0]->snAtivo == 'S')
			$snAtivo = 'N';
	
		if ($conteudos[0]->snAtivo == 'N')
			$snAtivo = 'S';
	
		$data	= array(
				'snAtivo' 	=> $snAtivo,
		);
	
		$this->db->where('idCadastro', $id);
		$this->db->update($this->tabela, $data);
	}
}

/* End of file newsletter.php */
/* Location: ./application/controllers/painel/newsletter.php */