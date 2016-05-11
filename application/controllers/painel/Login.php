<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	var $tabela	= 'usuario';
	var $pagina	= 'login';
	var $pasta	= '';
	var $titulo	= 'Acesse sua conta';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('painel');
		$this->load->helper('date');
	}

	public function index()
	{
		$data	= array(
				'titulo' 		=> $this->titulo,
				'acaoControl'	=> 'verificar',
				'erroExibe'		=> FALSE,
				'textoExibe'	=> 'Digite seu nome de usu&aacute;rio e senha.',
		);
		
		$this->load->view('painel/inicio/login', $data);
	}
	
	public function erro()
	{
		$data	= array(
				'titulo' 		=> $this->titulo,
				'acaoControl'	=> 'verificar',
				'erroExibe'		=> TRUE,
				'textoExibe'	=> 'Usu&aacute;rio ou Senha incorretos.',
		);
	
		$this->load->view('painel/inicio/login', $data);
	}
	
	public function verificar()
	{
		$dsLogin	= $this->input->post('dsLogin');
		$dsSenha	= md5($this->input->post('dsSenha'));
		
		$this->db->where('dsLogin',$dsLogin);
		$this->db->where('dsSenha',$dsSenha);
		$this->db->where('snAtivo','S');
		$conteudos	= $this->db->get($this->tabela)->result();
		
		if (count($conteudos) === 1)
		{
			$idUsuario	= $conteudos[0]->idUsuario;
			$nrAcesso	= $conteudos[0]->nrAcesso + 1;
			
			$session = array(
						'painel_idUsuario'	=> $idUsuario,
						'painel_dsNome'		=> $conteudos[0]->dsNome,
						'painel_dsLogin'	=> $conteudos[0]->dsLogin,
						'painel_nrAcesso'	=> $nrAcesso,
						'painel_idCrypt'	=> $conteudos[0]->idCrypt,
						'painel_dsImagem'	=> $conteudos[0]->dsImagem,
						'painel_logado'		=> TRUE
			);
			
			$data	= array(
					'nrAcesso'	=> $nrAcesso,
					'dtAcesso'	=> date('Y-m-d H:i:s'),
			);
			
			$this->db->where('idUsuario', $idUsuario);
			$this->db->update($this->tabela, $data);
			
			$this->session->set_userdata($session);
			
			if ($this->input->post('REFERER') != '')
				redirect($this->input->post('REFERER'));
			else
				redirect(base_url('painel/inicio'));
		}
		else
		{
			redirect(base_url('painel/'. $this->pagina .'/erro'));
		}
	}
	
	public function sair()
	{
		$this->session->sess_destroy();
		redirect(base_url('painel'));
	}
}

/* End of file login.php */
/* Location: ./application/controllers/painel/login.php */