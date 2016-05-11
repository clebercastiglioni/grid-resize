<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	var $tabela	= 'usuario';
	var $pagina	= 'usuarios';
	var $pasta	= 'usuarios';
	var $titulo	= 'Usu&aacute;rios';
	
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
		$this->db->select('idUsuario, dsNome, dsLogin, dtAcesso, nrAcesso, snAtivo');
		$this->db->order_by('dsNome', 'ASC');
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
		
		$data	= array(
				'dsNome' 		=> $this->input->post('dsNome'),
				'dsLogin'	 	=> $this->input->post('dsLogin'),
				'dsSenha'	 	=> md5($this->input->post('dsSenha')),
				'snAtivo' 		=> $this->input->post('snAtivo'),
				'idCrypt' 		=> $this->input->post('idCrypt'),
				'dtUsuario' 	=> date('Y-m-d H:i:s',now()),
		);
		
		if (isset($arquivo))
			$data['dsImagem']	= $arquivo['file_name'];
		
		$this->db->insert($this->tabela, $data);
		
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function editar($id)
	{
		$this->db->where('idUsuario', $id);
		
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
		
		$id = $this->input->post('idUsuario');
		
		$config['upload_path']		= './assets/files/'. $this->pasta;
		$config['allowed_types']	= 'gif|jpg|png';
		$config['encrypt_name']		= true;
		
		$this->load->library('upload', $config);

		$data	= array(
				'dsNome' 		=> $this->input->post('dsNome'),
				'dsLogin'	 	=> $this->input->post('dsLogin'),
				'snAtivo' 		=> $this->input->post('snAtivo'),
		);
		
		if ($this->input->post('dsSenha'))
		{
			$data['dsSenha'] = md5($this->input->post('dsSenha'));
		}
		
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
		
		if ($this->session->userdata('painel_idUsuario') == $id)
		{
			$session = array(
					'painel_dsNome'		=> $this->input->post('dsNome'),
					'painel_dsLogin'	=> $this->input->post('dsLogin'),
					'painel_logado'		=> TRUE
			);
			
			if (isset($arquivo['file_name']))
			{
				$session['painel_dsImagem']	= $arquivo['file_name'];
			}
			
			$this->session->set_userdata($session);
		}

		$this->db->where('idUsuario', $id);
		$this->db->update($this->tabela, $data);
		
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function excluir($id)
	{
		if ($this->input->post('idUsuario') != false) {
			$id = $this->input->post('idUsuario');
		}
		
		$this->db->select('dsImagem');
		$this->db->where('idUsuario', $id);
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
		
		$this->db->where('idUsuario', $id);
		$this->db->delete($this->tabela);
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function remover_imagem()
	{
		$id = $this->input->post('idUsuario');
		
		$this->db->select('dsImagem');
		$this->db->where('idUsuario', $id);
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
			$this->db->where('idUsuario', $id);
			$this->db->update($this->tabela, $data);
		}
	}
	
	public function ativo()
	{
		$id = $this->input->post('idUsuario');
	
		$this->db->where('idUsuario',$id);
		$conteudos = $this->db->get($this->tabela)->result();
	
		if ($conteudos[0]->snAtivo == 'S')
			$snAtivo = 'N';
	
		if ($conteudos[0]->snAtivo == 'N')
			$snAtivo = 'S';
	
		$data	= array(
				'snAtivo' 	=> $snAtivo,
		);
	
		$this->db->where('idUsuario', $id);
		$this->db->update($this->tabela, $data);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/painel/usuarios.php */