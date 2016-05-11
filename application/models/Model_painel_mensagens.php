<?php

class Model_painel_mensagens extends CI_Model
{
	private $tabela = 'contato';

	function count_rows($dsBusca = '')
	{
		$this->db->select('idContato');
		
		if ($dsBusca != '') {
			$this->db->like('dsAssunto', $dsBusca);
			$this->db->or_like('dsMensagem', $dsBusca);
		}
		
		return $this->db->count_all_results($this->tabela);
	}
	
	function get_all($de = 0, $quantidade = 9, $dsBusca = '')
	{
		$this->db->select('idContato, dsNome, dsAssunto, dtContato, snLido, dsEmail, dsMensagem');
		
		if ($dsBusca != '') {
			$this->db->like('dsAssunto', $dsBusca);
			$this->db->or_like('dsMensagem', $dsBusca);
		}
		
		$this->db->order_by('dtContato', 'DESC');
		$this->db->order_by('idContato', 'DESC');
		$this->db->limit($quantidade, $de);
		return $this->db->get($this->tabela);
	}
}