<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thumbs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('image_lib');
	}
	
	public function files($files, $tamanho, $width, $height, $tipo="o", $imagem="0")
	{
		if(!is_dir('assets/files/'. $files . '/thumbs/')){
			mkdir('assets/files/'. $files . '/thumbs/');
		}

		if(!is_dir('assets/files/'. $files . '/thumbs/' . $tamanho)){
			mkdir('assets/files/'. $files . '/thumbs/' . $tamanho);
		}

		$img 	= is_file('assets/files/'. $files .'/'. $imagem);
		$thumb 	= is_file('assets/files/'. $files .'/thumbs/'. $tamanho .'/'. $imagem);
		
		if ( ! $thumb)
		{
			if ($tipo == 'r')
			{
				$config['source_image'] = 'assets/files/'. $files .'/' . $imagem;
				$config['new_image']    = 'assets/files/'. $files .'/thumbs/'. $tamanho .'/' . $imagem;
				$config['width']        = $width * 2;
				$config['height']       = $height * 2;
				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				img_resizer('assets/files/'. $files .'/thumbs/'. $tamanho .'/' . $imagem,92,$width,$height,'assets/files/'. $files .'/thumbs/'. $tamanho .'/' . $imagem);
			}
			else 
			{
				$config['source_image'] = 'assets/files/'. $files .'/' . $imagem;
				$config['new_image']    = 'assets/files/'. $files .'/thumbs/'. $tamanho .'/' . $imagem;
				$config['width']        = $width;
				$config['height']       = $height;
				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}
		}
			
		header('Content-Type: image/jpg');
		
		if ($img)
		{
			readfile('assets/files/'. $files .'/thumbs/'. $tamanho .'/' . $imagem);
		}
		else 
		{
			if ($files == 'usuarios')
			{
				readfile('assets/admin/layout/img/avatar.png');
			}
			else
			{
				readfile('assets/global/img/space.png');
			}
		}
	}

	public function products($width, $height, $img)
	{
		// Checa se a imagem existe; se n�o existir, usa uma imagem padr�o
		$img = is_file('assets/main/images/products/'.$img) ? $img : 'default.jpg';

		// Se a miniatura j� existir, ela � que ser� usada
		// (n�o h� necessidade de usar a GD library de novo)
		if ( ! is_file('assets/main/images/products/thumbs/' . $width . 'x' . $height . '_' . $img))
		{
			$config['source_image'] = 'assets/main/images/products/' . $img;
			$config['new_image']    = 'assets/main/images/products/thumbs/' . $width . 'x' . $height . '_' . $img;
			$config['width']        = $width;
			$config['height']       = $height;
			 
			$this->image_lib->initialize($config);
			$this->image_lib->resize_crop();
		}
		 
		header('Content-Type: image/jpg');
		readfile('assets/main/images/products/thumbs/' . $width . 'x' . $height . '_' . $img);
	}

}

/* End of file thumbs.php */
/* Location: ./application/controllers/painel/thumbs.php */