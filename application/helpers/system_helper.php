<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('imagem')) {
	function imagem($files, $tamanho, $width, $height, $tipo="o", $imagem="0") {
		if (file_exists('./assets/files/'.$files.'/thumbs/'.$tamanho.'/'.$imagem))
			return base_url('assets/files/'.$files.'/thumbs/'.$tamanho.'/'.$imagem);
		else
			return base_url('Thumbs/files/'.$files.'/'.$tamanho.'/'.$width.'/'.$height.'/'.$tipo.'/'.$imagem);
	}
}

if (!function_exists('activeCheck')) {
	function activeCheck($urlSegment){
		$ci =& get_instance();
		$ci->load->database();

		if(is_array($urlSegment)){
			foreach ($urlSegment as $url) {
				if($ci->uri->segment(1) == $url)
					return "class='active'";
			}
		}else{
			if ($ci->uri->segment(1) == $urlSegment)
				return "class='active'";
			else
				return "";
		}
	}
}

if (!function_exists('isMobile')) {
    function isMobile() {
    	$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
    	return $isMobile;
    }
}

if (!function_exists('back')) {
	function back($default = '') {
		$default = base_url($default);
		return (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $default;
		
	}
}

if (!function_exists('onlyNumbers')) {

    function onlyNumbers($value) {
        return preg_replace('/\D/', '', $value);
    }
}

if ( ! function_exists('get_file_size'))
{
	function get_file_size($path)
	{
		$num = filesize($path);

		// code from byte_format()
		$CI =& get_instance();
		$CI->lang->load('number');

		$decimals = 1;

		if ($num >= 1000000000000)
		{
			$num = round($num / 1099511627776, 1);
			$unit = $CI->lang->line('terabyte_abbr');
		}
		elseif ($num >= 1000000000)
		{
			$num = round($num / 1073741824, 1);
			$unit = $CI->lang->line('gigabyte_abbr');
		}
		elseif ($num >= 1000000)
		{
			$num = round($num / 1048576, 1);
			$unit = $CI->lang->line('megabyte_abbr');
		}
		elseif ($num >= 1000)
		{
			$decimals = 0; // decimals are not meaningful enough at this point

			$num = round($num / 1024, 1);
			$unit = $CI->lang->line('kilobyte_abbr');
		}
		else
		{
			$unit = $CI->lang->line('bytes');
			return number_format($num).' '.$unit;
		}

		$str = number_format($num, $decimals).' '.$unit;

		$str = str_replace(' ', '&nbsp;', $str);
		return $str;
	}
}

if (!function_exists('get_file_extension'))
{
	function get_file_extension($file_name)
	{
		return substr(strrchr($file_name,'.'),1);
	}
}

if ( ! function_exists('config'))
{
	function config($i)
	{
		$ci =& get_instance();
		$ci->load->database();
		
		$sql = "SELECT dsConteudo FROM ".$ci->db->dbprefix('config')." WHERE dsConfig = '".$i."'";
		$row = $ci->db->query($sql);
		
		if ($row->num_rows() > 0)
		{
			return $row->row(0)->dsConteudo;	
		}	
	}
}

if ( ! function_exists('dt'))
{
	function dt($data)
	{
		$dataN = substr($data, 2, 1);
		
		if($dataN == '/')
		{
			return implode('-', array_reverse(explode('/', $data)));
		}
		else
		{
			return implode('/', array_reverse(explode('-', $data)));
		}
	}
}

if ( ! function_exists('dthr'))
{
	function dthr($data)
	{
		$dataE	= explode(' ', $data);
		$dataN	= substr($dataE[0], 2, 1);

		if($dataN == '/')
		{
			return implode('-', array_reverse(explode('/', $dataE[0]))).' - '.$dataE[1];
		}
		else
		{
			return implode('/', array_reverse(explode('-', $dataE[0]))).' - '.$dataE[1];
		}
	}
}

if ( ! function_exists('mes'))
{
	function mes($mes)
	{
		switch($mes)
		{
			case '1':  return 'Janeiro';   		break;
			case '2':  return 'Fevereiro'; 		break;
			case '3':  return 'Mar&ccedil;o';	break;
			case '4':  return 'Abril';     		break;
			case '5':  return 'Maio';      		break;
			case '6':  return 'Junho';     		break;
			case '7':  return 'Julho';     		break;
			case '8':  return 'Agosto';    		break;
			case '9':  return 'Setembro';  		break;
			case '10': return 'Outubro';   		break;
			case '11': return 'Novembro';  		break;
			case '12': return 'Dezembro';  		break;
			default:   return NULL;
		}
	}
}

function dataHojeOntem($data) {
	
	if (date('Y-m-d') == substr($data,0,10))
		$html = 'hoje';
	elseif (date('Y-m-d', strtotime("-1 day")) == substr($data,0,10))
		$html = 'ontem';
	elseif (date('Y-m-d', strtotime("-2 day")) == substr($data,0,10))	
		$html = diaSemana(substr($data,0,10));
	elseif (date('Y-m-d', strtotime("-3 day")) == substr($data,0,10))	
		$html = diaSemana(substr($data,0,10));
	else
		$html = substr(dt(substr($data,0,10)),0,5);
	
	return $html;
}

function diaSemana($data)
{
	$ano =  substr($data, 0, 4);
	$mes =  substr($data, 5, -3);
	$dia =  substr($data, 8, 9);

	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

	switch($diasemana) {
		case"0": $diasemana = "Domingo";       		break;
		case"1": $diasemana = "Segunda-Feira"; 		break;
		case"2": $diasemana = "Ter&ccedil;a-Feira";	break;
		case"3": $diasemana = "Quarta-Feira";  		break;
		case"4": $diasemana = "Quinta-Feira";  		break;
		case"5": $diasemana = "Sexta-Feira";   		break;
		case"6": $diasemana = "S&aacute;bado";      break;
	}

	return $diasemana;
}

if (!function_exists('get_file_extension')) {
	function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}
}

if ( ! function_exists('get_file_size'))
{
	function get_file_size($path)
	{
		$num = filesize($path);

		// code from byte_format()
		$CI =& get_instance();
		$CI->lang->load('number');

		$decimals = 1;

		if ($num >= 1000000000000)
		{
			$num = round($num / 1099511627776, 1);
			$unit = $CI->lang->line('terabyte_abbr');
		}
		elseif ($num >= 1000000000)
		{
			$num = round($num / 1073741824, 1);
			$unit = $CI->lang->line('gigabyte_abbr');
		}
		elseif ($num >= 1000000)
		{
			$num = round($num / 1048576, 1);
			$unit = $CI->lang->line('megabyte_abbr');
		}
		elseif ($num >= 1000)
		{
			$decimals = 0; // decimals are not meaningful enough at this point

			$num = round($num / 1024, 1);
			$unit = $CI->lang->line('kilobyte_abbr');
		}
		else
		{
			$unit = $CI->lang->line('bytes');
			return number_format($num).' '.$unit;
		}

		$str = number_format($num, $decimals).' '.$unit;

		$str = str_replace(' ', '&nbsp;', $str);
		return $str;
	}
}

function _ckdir($fn) {
	if (strpos($fn,"/") !== false) {
		$p=substr($fn,0,strrpos($fn,"/"));
		if (!is_dir($p)) {
			_o("Mkdir: ".$p);
			mkdir($p,755,true);
		}
	}
}

function img_resizer($src,$quality,$w,$h,$saveas) {
	/* v2.5 with auto crop */
	$r=1;
	$e=strtolower(substr($src,strrpos($src,".")+1,3));
	if (($e == "jpg") || ($e == "peg")) {
		$OldImage=ImageCreateFromJpeg($src) or $r=0;
	} elseif ($e == "gif") {
		$OldImage=ImageCreateFromGif($src) or $r=0;
	} elseif ($e == "bmp") {
		$OldImage=ImageCreateFromwbmp($src) or $r=0;
	} elseif ($e == "png") {
		$OldImage=ImageCreateFromPng($src) or $r=0;
	} else {
		_o("Not a Valid Image! (".$e.") -- ".$src);$r=0;
	}
	if ($r) {
		list($width,$height)=getimagesize($src);
		// check if ratios match
		$_ratio=array($width/$height,$w/$h);
		if ($_ratio[0] != $_ratio[1]) { // crop image

			// find the right scale to use
			$_scale=min((float)($width/$w),(float)($height/$h));

			// coords to crop
			$cropX=(float)($width-($_scale*$w));
			$cropY=(float)($height-($_scale*$h));

			// cropped image size
			$cropW=(float)($width-$cropX);
			$cropH=(float)($height-$cropY);

			$crop=ImageCreateTrueColor($cropW,$cropH);
			// crop the middle part of the image to fit proportions
			ImageCopy(
			$crop,
			$OldImage,
			0,
			0,
			(int)($cropX/2),
			(int)($cropY/2),
			$cropW,
			$cropH
			);
		}

		// do the thumbnail
		$NewThumb=ImageCreateTrueColor($w,$h);
		if (isset($crop)) { // been cropped
			ImageCopyResampled(
			$NewThumb,
			$crop,
			0,
			0,
			0,
			0,
			$w,
			$h,
			$cropW,
			$cropH
			);
			ImageDestroy($crop);
		} else { // ratio match, regular resize
			ImageCopyResampled(
			$NewThumb,
			$OldImage,
			0,
			0,
			0,
			0,
			$w,
			$h,
			$width,
			$height
			);
		}
		_ckdir($saveas);
		ImageJpeg($NewThumb,$saveas,$quality);
		ImageDestroy($NewThumb);
		ImageDestroy($OldImage);
	}
	return $r;
}
?>