<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Malote_model extends CI_Model{
		
		//Pega a sequência do malote
		public function pxSeq(){
				
			$seq['sequencia'] = '0';
			$this->db->insert('sequencia', $seq);		
			$id = $this->db->insert_id();		
			
			$dados = array('sequencia'=>$id);
			$this->db->where('id_sequencia', $id);
			$this->db->update('sequencia', $dados);
			
			return $id;
		}
		
		
		public function inserirItem($itens){
		
			$this->db->insert('itens', $itens);
		
		
		}
		
		
		public function inserirMalote($dados){
			
			$this->db->insert('malotes', $dados);
						
		}
		
		public function deletarItem($malote, $item){
		
			$this->db->where('id_malote', $malote);
			$this->db->where('id_seqItem', $item);
			return $this->db->delete('itens');
		
		
		}
		
		
		//Lista ou pega um Malote
		public function getMalote($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
			
			$this->db->select('id_malote, descricao_malote, dataEnvio_malote, dataAbertura_malote, dataAtualizacao_malote, usuarioDestino_malote, usuarioRemetente_malote, statusMalote, fechado_malote');
			$this->db->order_by("id_malote", "desc");
			$this->db->where($condicao);
			$this->db->from('malotes');
		
			if($primeiraLinha){
					
				return $this->db->get()->first_row();
					
					
			} else {
					
				$this->db->limit(LINHAS_PAGINA, $pagina);
					
				return $this->db->get()->result();
			}
		
		}
		
		public function getItem($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
				
			$this->db->select('id_tabItens, id_malote, id_seqItem, descricao_item, identificacao_item, id_statusItens');
			$this->db->where($condicao);
			$this->db->from('itens');
		
			if($primeiraLinha){
					
				return $this->db->get()->first_row();
					
					
			} else {
					
				$this->db->limit(LINHAS_PAGINA, $pagina);
					
				return $this->db->get()->result();
			}
		
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
		
		
		
		//Atualiza Malotes
		public function atualizaMalote($id_malote, $dados){
		
			$this->db->where( 'id_malote', $id_malote);
			$this->db->update( 'malotes', $dados );
		
		}
		
		//Atualiza itens
		public function atualizaItem($codicoes, $dados){
		
			$this->db->where($codicoes);
			$this->db->update( 'itens', $dados );
		
		}
		
		
		//Busca de iten
		public function busca($itemBuscar){
		
			$this->db->like('id_malote',$itemBuscar);
			$this->db->or_like('descricao_item',$itemBuscar);
			$this->db->or_like('identificacao_item',$itemBuscar);
			$this->db->from('itens');
			$qr = $this->db->get()->result();
			return $qr;
			
			
		}
		
		
		
		
	}