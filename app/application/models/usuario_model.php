<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Usuario_model extends CI_Model{
	
	
	public function insert($itens){
		
		$this->db->insert('usuarios', $itens);
		
		
	}
	
	
	public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
		$this->db->select('id_usu, primeiroNome_usu, ultimoNome_usu, login_usu, email_usu, tele_usu, desativado, dataCad_usu,  id_emp, id_tipoUsuario');
		$this->db->where($condicao);
		$this->db->from('usuarios');
		
		if($primeiraLinha){
			
			return $this->db->get()->first_row();
			
			
		} else {
			
			$this->db->limit(LINHAS_PAGINA, $pagina);
			
			return $this->db->get()->result();
		}
		
	}
	

	public function delete($id_usuario){
		
		$this->db->where('id_usu', $id_usuario);
		
		return $this->db->delete('usuarios');
		
		
	}
	
	
	public function update($id_usu, $itens){
		
		$this->db->where( 'id_usu', $id_usu );
		$this->db->update( 'usuarios', $itens );
	
	}
	
	
	# VALIDA USUÁRIO
	public function validate($login, $senha) {
		$this->db->where('login_usu', $login);
		$this->db->where('senha_usu', $senha);
		$this->db->where('status', 1); // Pega o status do usuário
		$this->db->from('usuarios');
		
		return $this->db->get()->result();
	
	}
	
	
	# VERIFICA SE O USUÁRIO ESTÁ LOGADO
	public function logado() {
		
	$logado = $this->session->userdata('logado');
	
	}
	
	public function getTipoUsuario() {
		$this->db->select('id_tipoUsuario, descricao_tipoUsuario');
		$this->db->from('tipoUsuario');
			
	 return $this->db->get()->result();
		
	}
	
	
	public function getUmUsuario($id_usuario){
		
		$this->db->where('id_usu', $id_usuario, TRUE);
		$this->db->from('usuarios');

		return $this->db->get()->first_row();
		
		
	}
		
}