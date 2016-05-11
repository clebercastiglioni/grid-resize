<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Contato extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		// PÁGINA CONTATO		
		$this->db->select('dsTitulo, dsPagina, dsTitle, dsDescription, dsKeywords');
		$this->db->where('dsLink', 'contato');
		$conteudos = $this->db->get('pagina')->result();
		// PÁGINA CONTATO
		
		$data = array(
				'dsTitle'		=> ($conteudos[0]->dsTitle == '' ? $conteudos[0]->dsTitulo : $conteudos[0]->dsTitle).' - '.config('TITULO'),
				'dsDescription' => $conteudos[0]->dsDescription,
				'dsKeywords'	=> $conteudos[0]->dsKeywords,
				'dsTitulo'		=> $conteudos[0]->dsTitulo,
				'dsPagina'		=> $conteudos[0]->dsPagina,
		);

		$this->load->view('site/contato', $data);
	}
	
	public function enviar()
	{
		$this->load->library('email');
		$this->load->library('form_validation');
		
		$this->load->helper('email');
		$this->load->helper('form');    	
		
		$this->form_validation->set_rules('dsNome', 'Seu nome', 'required');
		$this->form_validation->set_rules('dsEmail', 'Seu e-mail', 'required|valid_email');
	
		if ($this->form_validation->run() == false)
		{
			$data = array(
					'msg'	=> 'Preencha corretamente o formulário',
					'state'	=> 'error'    				
			);
			 
			echo json_encode($data);
		}
		else
		{
			$dsNome		= $this->input->post('dsNome');
			$dsEmail	= $this->input->post('dsEmail');
			$dsTelefone	= $this->input->post('dsTelefone');
			$dsCidade	= $this->input->post('dsCidade');
			$dsUnidade	= $this->input->post('dsUnidade');
			$dsAssunto  = 'Contato Site - '.$dsNome;
			$dsMensagem = strip_tags(stripslashes($this->input->post('dsMensagem')));
			$dtContato  = date('Y-m-d H:i:s');
			$dsIp       = $this->input->ip_address();
			$dsHost     = gethostbyaddr($dsIp);
		
			$msg        = '<font face="Verdana" size="2">'.date('d/m/Y H:i').'<br>
			<br>Nome: '.$dsNome.'
			<br>E-mail: '.$dsEmail.'
			<br>Telefone: '.$dsTelefone.'
			<br>Cidade: '.$dsCidade.'
			<br>Unidade: '.$dsUnidade.'
			<br>Assunto: '.$dsAssunto.'
			<br>Mensagem: ' .$dsMensagem. '
			<br><br>IP: '.$dsIp.'<br>Host: '.$dsHost.'<br></font>';
		
			$data	= array(
					'dsNome' 		=> $dsNome,
					'dsEmail' 		=> $dsEmail,
					'dsAssunto' 	=> $dsAssunto,
					'dsContato' 	=> $dsMensagem,
					'dsMensagem' 	=> $msg,
					'dtContato'		=> $dtContato,
			);
		
			$this->db->insert('contato', $data);
			
			// CADASTRO NEWSLETTER
			$this->db->select('idCadastro');
			$this->db->where('dsEmail', $dsEmail);
			$newsletters = $this->db->get('newsletter');
			
			if ($newsletters->num_rows() == 0)
			{
				$dados = array(
						'dsNome'		=> $dsNome,
						'dsEmail'		=> $dsEmail,
						'dtCadastro'	=> date('Y-m-d H:i:s'),
						'idGrupo'   	=> '1',
				);
			
				$this->db->insert('newsletter', $dados);
			}
			// CADASTRO NEWSLETTER
		
			// ENVIAR EMAIL
			if (config('SMTP') == 'S')
			{
				if (config('EMAIL') != '')
				{
					$config['smtp_host']    = config('SMTP_HOST');
					$config['smtp_port']    = "587";
					$config['protocol']     = "smtp";
					$config['smtp_user']    = config('SMTP_USUARIO');
					$config['smtp_pass']    = config('SMTP_SENHA');
					$config['charset']      = "utf-8";
					$config['mailtype']     = "html";
					$config['newline']      = "\r\n";
					$config['wordwrap']     = true;
		
					$this->email->initialize();
					$this->email->from(config('EMAIL'), config('TITULO'));
					$this->email->reply_to($dsEmail, $dsNome);
					$this->email->to(config('EMAIL'));
					$this->email->subject($dsAssunto);
					$this->email->message($msg);
		
					if ($this->email->send())
					{
						$data = array(
								'msg'	=> 'Mensagem enviada com sucesso',
								'state'	=> 'success'
						);
						
						echo json_encode($data);
					}
					else
					{
						$data = array(
								'msg'	=> 'Erro ao enviar mensagem',
								'state'	=> 'error'
						);
						
						echo json_encode($data);
					}
				}
			}
			else
			{
				if (config('EMAIL') != '')
				{
					$this->email->from(config('EMAIL'), config('TITULO'));
					$this->email->reply_to($dsEmail, $dsNome);
					$this->email->to(config('EMAIL'));
					$this->email->subject($dsAssunto);
					$this->email->set_mailtype("html");
					$this->email->message($msg);
		
					if ($this->email->send())
					{
						$data = array(
								'msg'	=> 'Mensagem enviada com sucesso',
								'state'	=> 'success'
						);
						
						echo json_encode($data);
					}
					else
					{
						$data = array(
								'msg'	=> 'Erro ao enviar mensagem',
								'state'	=> 'error'
						);
						
						echo json_encode($data);
					}
				}
			}
		}
		exit;
	}
}

/* End of file contato.php */
/* Location: ./application/controllers/contato.php */