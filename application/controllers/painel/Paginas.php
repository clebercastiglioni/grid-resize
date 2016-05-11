<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends CI_Controller {
	
	var $tabela	= 'pagina';
	var $pagina	= 'paginas';
	var $pasta	= 'paginas';
	var $titulo	= 'P&aacute;ginas';
	
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
		$this->db->select('idPagina, dsTitulo, snGaleria, snVideo');
		$this->db->order_by('dsTitulo', 'ASC');
		$conteudos = $this->db->get($this->tabela);
		 
		$data	= array(
				'titulo'	=> $this->titulo,
				'conteudos' => $conteudos,
		);

		$this->load->view('painel/'. $this->pagina .'/list', $data);
	}
	
	public function editar($id)
	{
		$this->db->where('idPagina', $id);
		
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
		
		$id = $this->input->post('idPagina');
		
		$config['upload_path']		= './assets/files/'. $this->pasta;
		$config['allowed_types']	= 'gif|jpg|png|doc|docx|pdf';
		$config['encrypt_name']		= true;
		
		$this->load->library('upload', $config);

		$data	= array(
				'dsTitulo' 		=> $this->input->post('dsTitulo'),
				'dsPagina' 		=> $this->input->post('dsPagina'),
				'dsTitle' 		=> $this->input->post('dsTitle'),
				'dsDescription' => $this->input->post('dsDescription'),
				'dsKeywords' 	=> $this->input->post('dsKeywords'),
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
		
		// ARQUIVO
		if ($this->upload->do_upload('dsArquivo'))
		{
			$path = './assets/files/'. $this->pasta .'/'. $this->input->post('dsFile');
			if (is_file($path)) unlink($path);
		
			$arquivo2		= $this->upload->data();
			$data['dsFile']	= $arquivo2['file_name'];
		}
		// ARQUIVO

		$this->db->where('idPagina', $id);
		$this->db->update($this->tabela, $data);
		
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function excluir($id)
	{
		if ($this->input->post('idPagina') != false) {
			$id = $this->input->post('idPagina');
		}
		
		$this->db->select('dsImagem, dsFile');
		$this->db->where('idPagina', $id);
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
		
		if (isset($conteudos[0]->dsFile) and $conteudos[0]->dsFile != '')
		{
			$path = './assets/files/'. $this->pasta .'/'. $conteudos[0]->dsFile;
			if (is_file($path)) unlink($path);
		}
		
		$this->db->where('idPagina', $id);
		$this->db->delete($this->tabela);
		redirect(base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}
	
	public function remover_imagem()
	{
		$id = $this->input->post('idPagina');
		
		$this->db->select('dsImagem');
		$this->db->where('idPagina', $id);
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
			$this->db->where('idPagina', $id);
			$this->db->update($this->tabela, $data);
		}
	}
	
	public function remover_arquivo()
	{
		$id = $this->input->post('idPagina');
	
		$this->db->select('dsFile');
		$this->db->where('idPagina', $id);
		$conteudos = $this->db->get($this->tabela)->result();
	
		if (isset($conteudos[0]->dsFile) and $conteudos[0]->dsFile != '')
		{
			$path = './assets/files/'. $this->pasta .'/'. $conteudos[0]->dsFile;
			if (is_file($path)) unlink($path);
	
			$data['dsFile']	= '';
			$this->db->where('idPagina', $id);
			$this->db->update($this->tabela, $data);
		}
	}
	
	public function ativo()
	{
		$id = $this->input->post('idPagina');
	
		$this->db->where('idPagina',$id);
		$conteudos = $this->db->get($this->tabela)->result();
	
		if ($conteudos[0]->snAtivo == 'S')
			$snAtivo = 'N';
	
		if ($conteudos[0]->snAtivo == 'N')
			$snAtivo = 'S';
	
		$data	= array(
				'snAtivo' 	=> $snAtivo,
		);
	
		$this->db->where('idPagina', $id);
		$this->db->update($this->tabela, $data);
	}
	
	public function img($id)
	{
		if ($this->input->post('idImg') != false) {
			$id = $this->input->post('idImg');
		}
	
		$this->db->select('dsTitulo');
		$this->db->where('idPagina', $id);
		$this->db->limit(1);
		$galerias = $this->db->get($this->tabela)->result();
			
		if (isset($galerias[0]->dsTitulo))
			$dsGaleria = $galerias[0]->dsTitulo;
	
		$this->db->select('idImg, sqOrdem, idPagina, dsTitulo, snAtivo, dsImagem');
		$this->db->where('idPagina', $id);
		$this->db->where('tpImg', 'F');
		$this->db->order_by('sqOrdem', 'ASC');
		$conteudos = $this->db->get($this->tabela .'_img');
			
		$data	= array(
				'titulo'		=> $this->titulo,
				'galeria'		=> $dsGaleria,
				'id_galeria'	=> $id,
				'conteudos' 	=> $conteudos,
		);
	
		$this->load->view('painel/'. $this->pagina .'/img', $data);
	}
	
	public function img_salvar($id)
	{
		pasta($this->pasta);
	
		$config['upload_path']		= './assets/files/'. $this->pasta;
		$config['allowed_types']	= 'gif|jpg|png';
		$config['encrypt_name']		= true;
	
		$this->load->library('upload', $config);
	
		if ($this->upload->do_upload('file'))
			$arquivo = $this->upload->data();
	
		// ORDEM
		$this->db->select('sqOrdem');
		$this->db->where('idPagina', $id);
		$this->db->order_by('sqOrdem', 'DESC');
		$this->db->limit(1);
		$imgs = $this->db->get($this->tabela .'_img')->result();
			
		if (isset($imgs[0]->sqOrdem))
			$sqOrdem = $imgs[0]->sqOrdem + 1;
		else
			$sqOrdem = 1;
		//
	
		$data	= array(
				'idPagina' 	=> $id,
				'sqOrdem' 	=> $sqOrdem,
				'dsImagem' 	=> $arquivo['file_name'],
		);
	
		$this->db->insert($this->tabela .'_img', $data);
	}
	
	public function img_alterar($id)
	{
		if ($this->input->post('idImg') != false) {
			$id = $this->input->post('idImg');
		}
	
		$this->db->where('idImg',$id);
		$conteudos = $this->db->get($this->tabela .'_img')->result();
	
		if ($conteudos[0]->snAtivo == 'S')
			$snAtivo = 'N';
	
		if ($conteudos[0]->snAtivo == 'N')
			$snAtivo = 'S';
	
		$data	= array(
				'snAtivo' 	=> $snAtivo,
		);
	
		$this->db->where('idImg', $id);
		$this->db->update($this->tabela .'_img', $data);
	}
	
	public function img_excluir($id)
	{
		if ($this->input->post('idImg') != false) {
			$id = $this->input->post('idImg');
		}
	
		$this->db->select('dsImagem');
		$this->db->where('idImg', $id);
		$conteudos = $this->db->get($this->tabela .'_img')->result();
	
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
	
		$this->db->where('idImg', $id);
		$this->db->delete($this->tabela .'_img');
	}
	
	public function img_ordem($id='', $sqOrdem='')
	{
		if ($this->input->post('idImg') != false) {
			$id = $this->input->post('idImg');
		}
	
		if ($this->input->post('sqOrdem') != false) {
			$sqOrdem = $this->input->post('sqOrdem');
		}
	
		$data	= array(
				'sqOrdem' 	=> $sqOrdem,
		);
	
		$this->db->where('idImg', $id);
		$this->db->update($this->tabela .'_img', $data);
	}
	
	public function img_titulo($id='', $dsTitulo='')
	{
		if ($this->input->post('idImg') != false) {
			$id = $this->input->post('idImg');
		}
	
		if ($this->input->post('dsTitulo') != false) {
			$dsTitulo = $this->input->post('dsTitulo');
		}
	
		$data	= array(
				'dsTitulo' 	=> $dsTitulo,
		);
	
		$this->db->where('idImg', $id);
		$this->db->update($this->tabela .'_img', $data);
	}
	
	public function video($id)
	{
		if ($this->input->post('idImg') != false) {
			$id = $this->input->post('idImg');
		}
	
		$this->db->select('dsTitulo');
		$this->db->where('idPagina', $id);
		$this->db->limit(1);
		$galerias = $this->db->get($this->tabela)->result();
			
		if (isset($galerias[0]->dsTitulo))
			$dsGaleria = $galerias[0]->dsTitulo;
	
		$this->db->select('idImg, idPagina, snAtivo, dsImagem');
		$this->db->where('tpImg', 'V');
		$this->db->where('idPagina', $id);
		$this->db->order_by('sqOrdem', 'ASC');
		$conteudos = $this->db->get($this->tabela .'_img');
			
		$data	= array(
				'titulo'		=> $this->titulo,
				'galeria'		=> $dsGaleria,
				'id_galeria'	=> $id,
				'conteudos' 	=> $conteudos,
		);
	
		$this->load->view('painel/'. $this->pagina .'/video', $data);
	}
	
	public function video_salvar($id)
	{
		$this->load->library('curl');
		$this->load->helper('file');
	
		$img = $this->curl->simple_get('http://img.youtube.com/vi/'. $this->input->post('dsImagem') .'/hqdefault.jpg');
		write_file('./assets/files/'. $this->pasta .'/'. $this->input->post('dsImagem') .'.jpg', $img);
	
		// ORDEM
		$this->db->select('sqOrdem');
		$this->db->order_by('sqOrdem', 'DESC');
		$this->db->limit(1);
		$imgs = $this->db->get($this->tabela .'_img')->result();
			
		if (isset($imgs[0]->sqOrdem))
			$sqOrdem = $imgs[0]->sqOrdem + 1;
		else
			$sqOrdem = 1;
		//
	
		$data	= array(
				'idPagina' 		=> $id,
				'sqOrdem' 		=> $sqOrdem,
				'tpImg' 		=> 'V',
				'dsImagem' 		=> $this->input->post('dsImagem').'.jpg',
		);
	
		$this->db->insert($this->tabela .'_img', $data);
		redirect(base_url('painel/'. $this->pagina .'/video/'. $id));
	}
}

/* End of file paginas.php */
/* Location: ./application/controllers/painel/paginas.php */