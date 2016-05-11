<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends CI_Controller {
	
	var $tabela	= 'banner';
	var $pagina	= 'banners';
	var $pasta	= 'banners';
	var $titulo	= 'Banners';
	
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
		$this->listar();
	}
	
	public function listar()
	{
		$this->db->select('idBanner, sqOrdem, dsTitulo, snAtivo');
		$this->db->order_by('sqOrdem', 'ASC');
		$this->db->order_by('dsTitulo', 'ASC');
		$conteudos = $this->db->get($this->tabela);
		 
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
		pasta($this->pasta);
		
		$config['upload_path']		= './assets/files/'. $this->pasta;
		$config['allowed_types']	= 'gif|jpg|png';
		$config['encrypt_name']		= true;
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload())
			$arquivo = $this->upload->data();
		
		if ($this->input->post('sqOrdem'))
		{
			$sqOrdem	= $this->input->post('sqOrdem');
		}
		else
		{
			$this->db->select('sqOrdem');
			$this->db->order_by('sqOrdem', 'DESC');
			$this->db->limit(1);
			$banners = $this->db->get($this->tabela)->result();
			
			if (isset($banners[0]->sqOrdem))
				$sqOrdem = $banners[0]->sqOrdem + 1;
			else
				$sqOrdem = 1;
		}
		
		$data	= array(
				'sqOrdem' 		=> $sqOrdem,
				'dsTitulo' 		=> $this->input->post('dsTitulo'),
				'dsBanner' 		=> $this->input->post('dsBanner'),
				'dsLink' 		=> $this->input->post('dsLink'),
				'snAtivo' 		=> $this->input->post('snAtivo'),
		);
		
		if (isset($arquivo))
			$data['dsImagem']	= $arquivo['file_name'];
		
		$this->db->insert($this->tabela, $data);
		
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function editar($id)
	{
		$this->db->where('idBanner', $id);
		
		$data	= array(
				'titulo' 		=> $this->titulo,
				'acaoControl'	=> 'alterar',
				'conteudos'		=> $this->db->get($this->tabela)->result(),
		);
		
		$this->load->view('painel/'. $this->pagina .'/form', $data);
	}
	
	public function alterar()
	{
		pasta($this->pasta);
		
		$id = $this->input->post('idBanner');
		
		$config['upload_path']		= './assets/files/'. $this->pasta;
		$config['allowed_types']	= 'gif|jpg|png';
		$config['encrypt_name']		= true;
		
		$this->load->library('upload', $config);

		$data	= array(
				'sqOrdem' 		=> $this->input->post('sqOrdem'),
				'dsTitulo' 		=> $this->input->post('dsTitulo'),
				'dsBanner' 		=> $this->input->post('dsBanner'),
				'dsLink' 		=> $this->input->post('dsLink'),
				'snAtivo' 		=> $this->input->post('snAtivo'),
		);
		
		if ($this->upload->do_upload())
		{
			$path = './assets/files/'. $this->pasta .'/'. $this->input->post('dsImagem');
			if (is_file($path)) unlink($path);
			
			$path = './assets/files/'. $this->pasta .'/thumbs/p/'. $this->input->post('dsImagem');
			if (is_file($path)) unlink($path);
			
			$path = './assets/files/'. $this->pasta .'/thumbs/m/'. $this->input->post('dsImagem');
			if (is_file($path)) unlink($path);
			
			$path = './assets/files/'. $this->pasta .'/thumbs/g/'. $this->input->post('dsImagem');
			if (is_file($path)) unlink($path);
			
			$arquivo			= $this->upload->data();
			$data['dsImagem']	= $arquivo['file_name'];
		}

		$this->db->where('idBanner', $id);
		$this->db->update($this->tabela, $data);
		
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function excluir($id)
	{
		if ($this->input->post('idBanner') != false) {
			$id = $this->input->post('idBanner');
		}
		
		$this->db->select('dsImagem');
		$this->db->where('idBanner', $id);
		$conteudos = $this->db->get($this->tabela)->result();
		
		if (isset($conteudos[0]->dsImagem) and $conteudos[0]->dsImagem != '')
		{
			$path = './assets/files/'. $this->pasta .'/'. $conteudos[0]->dsImagem;
			if (is_file($path)) unlink($path);
			
			$path = './assets/files/'. $this->pasta .'/thumbs/p/'. $conteudos[0]->dsImagem;
			if (is_file($path)) unlink($path);
			
			$path = './assets/files/'. $this->pasta .'/thumbs/m/'. $conteudos[0]->dsImagem;
			if (is_file($path)) unlink($path);
			
			$path = './assets/files/'. $this->pasta .'/thumbs/g/'. $conteudos[0]->dsImagem;
			if (is_file($path)) unlink($path);
		}
		
		$this->db->where('idBanner', $id);
		$this->db->delete($this->tabela);
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function remover_imagem()
	{
		$id = $this->input->post('idBanner');
		
		$this->db->select('dsImagem');
		$this->db->where('idBanner', $id);
		$conteudos = $this->db->get($this->tabela)->result();
		
		if (isset($conteudos[0]->dsImagem) and $conteudos[0]->dsImagem != '')
		{
			$path = './assets/files/'. $this->pasta .'/'. $conteudos[0]->dsImagem;
			if (is_file($path)) unlink($path);
				
			$path = './assets/files/'. $this->pasta .'/thumbs/p/'. $conteudos[0]->dsImagem;
			if (is_file($path)) unlink($path);
			
			$path = './assets/files/'. $this->pasta .'/thumbs/m/'. $conteudos[0]->dsImagem;
			if (is_file($path)) unlink($path);
			
			$path = './assets/files/'. $this->pasta .'/thumbs/g/'. $conteudos[0]->dsImagem;
			if (is_file($path)) unlink($path);
			
			$data['dsImagem']	= '';
			$this->db->where('idBanner', $id);
			$this->db->update($this->tabela, $data);
		}
	}
	
	public function ativo()
	{
		$id = $this->input->post('idBanner');
	
		$this->db->where('idBanner',$id);
		$conteudos = $this->db->get($this->tabela)->result();
	
		if ($conteudos[0]->snAtivo == 'S')
			$snAtivo = 'N';
	
		if ($conteudos[0]->snAtivo == 'N')
			$snAtivo = 'S';
	
		$data	= array(
				'snAtivo' 	=> $snAtivo,
		);
	
		$this->db->where('idBanner', $id);
		$this->db->update($this->tabela, $data);
	}
}

/* End of file banners.php */
/* Location: ./application/controllers/painel/banners.php */