<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class TrabalheConosco extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		// PÁGINA TRABALHE CONOSCO		
		$this->db->select('dsTitulo, dsPagina, dsTitle, dsDescription, dsKeywords');
		$this->db->where('dsLink', 'trabalhe-conosco');
		$conteudos = $this->db->get('pagina')->result();
		// PÁGINA TRABALHE CONOSCO
		
		// ESTADOS
		$this->db->select('dsSigla');
		$this->db->order_by('dsSigla', 'ASC');
		$estados = $this->db->get('estado')->result();
		// ESTADOS
		
		$data = array(
				'dsTitle'		=> ($conteudos[0]->dsTitle == '' ? $conteudos[0]->dsTitulo : $conteudos[0]->dsTitle).' - '.config('TITULO'),
				'dsDescription' => $conteudos[0]->dsDescription,
				'dsKeywords'	=> $conteudos[0]->dsKeywords,
				'dsTitulo'		=> $conteudos[0]->dsTitulo,
				'dsPagina'		=> $conteudos[0]->dsPagina,
				'estados'		=> $estados,
		);

		$this->load->view('site/trabalhe-conosco', $data);
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
			$return = 'Preencha corretamente o formulário';
		else
		{
			$pasta = 'curriculos';
			
			$config['upload_path']      = './assets/files/'.$pasta;
			$config['allowed_types']    = 'pdf|doc|docx';
			$config['encrypt_name']     = true;
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload())
				$arquivo = $this->upload->data();
			
			if (isset($arquivo)) 
			{
				$dsFile = $arquivo['file_name'];
				$dsCurriculo = '<br>Link: '.base_url('assets/files/'.$pasta.'/'.$dsFile);
			}
			else
				$dsCurriculo = '';
			
			$dsNome		= $this->input->post('dsNome');
			$dsEmail	= $this->input->post('dsEmail');
			$dsTelefone	= $this->input->post('dsTelefone');
			$dsCidade	= $this->input->post('dsCidade');
			$dsEstado	= $this->input->post('dsEstado');
			$dsAssunto  = 'Trabalhe Conosco - '.$dsNome;
			$dsMensagem = strip_tags(stripslashes($this->input->post('dsMensagem')));
			$dtContato  = date('Y-m-d H:i:s');
			$dsIp       = $this->input->ip_address();
			$dsHost     = gethostbyaddr($dsIp);
		  
			$msg        = '<font face="Verdana" size="2">'.date('d/m/Y H:i').'<br>
			<br>Nome: '.$dsNome.'
			<br>E-mail: '.$dsEmail.'
			<br>Telefone: '.$dsTelefone.'
			<br>Cidade: '.$dsCidade.'
			<br>Estado: '.$dsEstado.'
			<br>Assunto: '.$dsAssunto.'
			<br>Mensagem: ' .$dsMensagem. '
			'.$dsCurriculo.'  
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
					 
					if (@$this->email->send())
						$return = 'Currículo enviado com sucesso';
					else
						$return = 'Erro ao enviar currículo';
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
					 
					if (@$this->email->send())
						$return = 'Currículo enviado com sucesso.';
					else
						$return = 'Erro ao enviar currículo';
				}
			}
		}
		
		echo '<script>alert("'.$return.'");window.history.back();</script>';
	}
}

/* End of file Trabalheconosco.php */
/* Location: ./application/controllers/Trabalheconosco.php */