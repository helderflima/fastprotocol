<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Empresa_model extends CI_Model{
		
		public function post($itens){
				
			$this->db->insert('empresas', $itens);		
			
		}
		
		
		
		public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0 ){
			
			$this->db->select('id_emp, nome_emp, cnpj_emp, insEst_emp, insMun_emp, email_emp, tele_emp, nomeResp_emp, logradouro_emp, numEnd_emp, compleEnd_emp, bairro_emp, cidade_emp, estado_emp, cep_emp, ativo');
			$this->db->where($condicao);
			$this->db->from('empresas');
			
			
			if($primeiraLinha){
				
				return $this->db->get()->first_row();
				
			} else {
				
				$this->db->limit(LINHAS_PAGINA, $pagina);
				return $this->db->get()->result();
				
			}
			
			
		}

		
		public function listarEmpUsuario($condicao){
			
			$this->db->select('nome_emp');
			$this->db->where('id_emp', $condicao);
			$this->db->from('empresas');
			
				
				return $this->db->get()->first_row();	
			
		}
		
		public function delete($idEmpresa){
			
			$this->db->where('id_emp', $idEmpresa);
			return $this->db->delete('empresas');
			
					
		} 
		
		public function update($id_emp, $itens){
		
			$this->db->where( 'id_emp', $id_emp );
			$this->db->update( 'empresas', $itens );
		
		}
	
	}
