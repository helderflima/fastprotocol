<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Status_model extends CI_Model{
	
	
	public function insert($itens){
		
		$this->db->insert('usuarios', $itens);
		
		
	}
	
	
	public function getStatusMalote($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
		$this->db->select('id_statusMalote, descricao_statusMalote');
		$this->db->where($condicao);
		$this->db->from('statusmalote');
		
		if($primeiraLinha){
			
			return $this->db->get()->first_row();
			
			
		} else {
			
			$this->db->limit(LINHAS_PAGINA, $pagina);
			
			return $this->db->get()->result();
		}
		
	}
		
}