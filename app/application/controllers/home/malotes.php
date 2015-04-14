<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );





class Malotes extends CI_Controller {

	
	
	
	
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'home_model', 'HomeM' );
		$this->load->model ( 'malote_model', 'MaloteM' );
		$this->load->model ( 'usuario_model', 'UsuarioM' );
		$this->load->model ( 'empresa_model', 'EmpresaM' );
		$this->load->model ( 'status_model', 'StatusM' );
		date_default_timezone_set ( "America/Araguaina" );
		
	}
	
	
	
	
	public function novoMalote() {
		$id = $this->MaloteM->pxSeq ();
		
		$dados = array ();
		$dados ['DOCBUSCAR'] 			= "";
		$dados ['MOSTRARMENUCADASTRO'] 	= $this->mostrarMenuCadastro ( $this->session->userdata ( 'nivelLogado' ) );
		$dados ['URLLISTARMALOTES'] 	= site_url ( 'home/malotes' );
		$dados ['URLLISTAREMP'] 		= site_url ( 'painel/empresa' );
		$dados ['URLLISTARUSU'] 		= site_url ( 'painel/usuario' );
		$dados ['BLC_DADOITENS']		= array ();
		$dados ['BLC_USUARIOS'] 		= array ();
		$dados ['BLC_SEMITENS'] 		= array ();
		$dados ['id_malote'] 			= $id;
		$dados ['ACAO'] 				= 'Novo';
		$dados ['descricao_malote'] 	= '';
		$dados ['remetente_malote']		= '';
		$dados ['USERLOGADO'] = $this->session->userdata ( 'primeiroNome_usu' );
		
		$res = $this->UsuarioM->get ( array () );
		
		if ($res) {
			foreach ( $res as $r ) {
				
				$dadosEmp = array (
						'id_emp' => $r->id_emp 
				);
				
				$nomeEmp = $this->EmpresaM->get ( $dadosEmp, TRUE );
				$res = $this->EmpresaM->get ( array () );
				
				$dados ['BLC_USUARIOS'] [] = array (
						
						"id_usu" => $r->id_usu,
						"destinatario_malote" => $r->primeiroNome_usu,
						"empresa_destinatario" => $nomeEmp->nome_emp 
				);
			}
		} else {
			
			$dados ['BLC_SEMDADOS'] [] = array ();
		}
		
		$this->parser->parse ( 'home/telas/form_malotes', $dados );
	}
	
	
	
	
	
	public function incluirItem() {
		$malote = $this->input->post ( 'id_malote' );
		$id_destinatario = $this->tratarDestinatario ( $this->input->post ( 'id_destinatario' ) );
		
		$dadosMalote ['id_malote'] 					= $malote;
		$dadosMalote ['usuarioRemetente_malote'] 	= $this->session->userdata ( 'id_usu' );
		$dadosMalote ['usuarioDestino_malote'] 		= $id_destinatario;
		$dadosMalote ['descricao_malote'] 			= $this->input->post ( 'descricao_malote' );
		$dadosMalote ['dataEnvio_malote'] 			= '';
		$dadosMalote ['dataAbertura_malote'] 		= '';
		$dadosMalote ['dataAtualizacao_malote'] 	= '';
		$dadosMalote ['statusMalote'] 				= '1';
			
		if (! $this->MaloteM->getMalote ( array (
				'id_malote' => $malote 
		), TRUE )) {
			
			$this->MaloteM->inserirMalote ( $dadosMalote );
		} else {
			
			$this->atualizaMalote ( $dadosMalote );
		}
		
		$dados ['id_malote'] 			= $this->input->post ( 'id_malote' );
		$dados ['id_seqItem'] 			= $this->input->post ( 'id_seqItem' );
		$dados ['descricao_item'] 		= $this->input->post ( 'descricao' );
		$dados ['identificacao_item'] 	= $this->input->post ( 'identificacao' );
		$dados ['id_statusItens'] 		= '1';
		
		if (! $this->input->is_ajax_request ()) {
			
			redirect ( '404' );
		} else {
			
			$this->MaloteM->inserirItem ( $dados );
			echo TRUE;
		}
	}
	
	
	
	
	
	public function excluirItem() {
		$malote = $this->input->post ( 'id_malote' );
		$item = $this->input->post ( 'id_seqItem' );
		
		$resp = $this->MaloteM->deletarItem ( $malote, $item );
		
		if (! $resp) {
			
			echo FALSE;
		} else {
			
			echo TRUE;
		}
	}
	
	
	
	
	
	// Pega o código do formulário da listbox do formulário do malote
	public function tratarDestinatario($nomeUsuario) {
		$usu = explode ( "-", $nomeUsuario );
		
		$remetente = $usu [0];
		$remetente = ltrim ( $remetente );
		$remetente = rtrim ( $remetente );
		
		return $remetente;
	}
	
	
	
	
	
	// Atualiza os campos da tabela malotes
	public function atualizaMalote($dadosRec) {
		$id_malote = $dadosRec ['id_malote'];
		
		if ($dadosRec ['descricao_malote']) {
			
			$dados ['descricao_malote'] = $dadosRec ['descricao_malote'];
		}
		;
		
		if ($dadosRec ['dataEnvio_malote']) {
			
			$dados ['dataEnvio_malote'] = $dadosRec ['dataEnvio_malote'];
		}
		;
		
		if ($dadosRec ['dataAbertura_malote']) {
			
			$dados ['dataAbertura_malote'] = $dadosRec ['dataAbertura_malote'];
		}
		;
		
		if ($dadosRec ['dataAtualizacao_malote']) {
			
			$dados ['dataAtualizacao_malote'] = $dadosRec ['dataAtualizacao_malote'];
		}
		;
		
		if ($dadosRec ['statusMalote']) {
			
			$dados ['statusMalote'] = $dadosRec ['statusMalote'];
		}
		;
		
		if ($dadosRec ['usuarioDestino_malote']) {
			
			$dados ['usuarioDestino_malote'] = $dadosRec ['usuarioDestino_malote'];
		}
		;
		
		$this->MaloteM->atualizaMalote ( $id_malote, $dados );
	}
	
	
	
	
	
	// Lista os malotes enviados
	public function malotesEnviados() {
		$data = array ();
		$data ['MOSTRARMENUCADASTRO'] 	= $this->mostrarMenuCadastro ( $this->session->userdata ( 'nivelLogado' ) );
		$data ['DOCBUSCAR'] 			= "";
		$data ['URLFORMMALOTE'] 		= site_url ( 'home/malotes/novoMalote' );
		$data ['URLLISTAREMP'] 			= site_url ( 'painel/empresa' );
		$data ['URLLISTARUSU'] 			= site_url ( 'painel/usuario' );
		$data ['BLC_DADOS'] 			= array ();
		$data ['BLC_SEMDADOS'] 			= array ();
		$data ['USERLOGADO'] 			= $this->session->userdata ( 'primeiroNome_usu' );
		$data ['MOSTRARMENUCADASTRO'] 	= $this->mostrarMenuCadastro ( $this->session->userdata ( 'nivelLogado' ) );
		
		$pagina = $this->input->get ( 'pagina' );
		
		if (! $pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina - 1) * LINHAS_PAGINA;
		}
		
		$res = $this->MaloteM->getMalote ( array (
				'usuarioRemetente_malote' => $this->session->userdata ( 'id_usu' ) 
		), FALSE );
		
		if ($res) {
			foreach ( $res as $r ) {
				
				$usuEmp = $this->getUsuarioEmpresa ( $r->usuarioDestino_malote );
				
				$status = $this->StatusM->getStatusMalote ( array (
						'id_statusMalote' => $r->statusMalote 
				), TRUE );
				
				$fechado = "";
				
				/*
				 * if ($r->statusMalote == '2') { $botao = "<button onclick='visualizarMalote(".$r->id_malote.")'class='botao btn btn-info'>Visualizar</button>"; } else { $botao = "<button onclick='receberMalote(".$r->id_malote.")'class='btn btn-warning'>Editar</button>"; }
				 */
				
				$fechado = "";
				
				if ($r->statusMalote == '2') {
					
					$botao = "<button onclick='visualizarMaloteRemetente(" . $r->id_malote . ")'class='botao btn btn-info'>Visualizar</button>";
				} else {
					
					$botao = "<button onclick='receberMalote(" . $r->id_malote . ")'class='botao btn btn-warning'>Editar</button>";
				}
				
				$data ['BLC_DADOS'] [] = array (
						
						"id_malote" 			=> $r->id_malote,
						"usuarioDestino_malote" => $usuEmp ['nomeUsuario'],
						"empresaUsuario_malote" => $usuEmp ['nomeEmpresa'],
						"dataEnvio_malote" 		=> $this->tratarDataHora ( $r->dataEnvio_malote ),
						"statusMalote" 			=> $status->descricao_statusMalote,
						"BOTAOLISTENVIADOS" 	=> $botao 
				);
			}
		} else {
			
			$data ['BLC_SEMDADOS'] [] = array ();
		}
		
		$this->parser->parse ( 'home/telas/list_malotesEnviados', $data );
	}
	
	
	
	
	
	// Lista os malotes recebido
	public function index() {
		
		
		
		$data = array ();
		$data ['MOSTRARMENUCADASTRO'] 	= $this->mostrarMenuCadastro ( $this->session->userdata ( 'nivelLogado' ) );
		$data ['DOCBUSCAR'] 			= "";
		$data ['URLMALOTESENVIADOS'] 	= site_url ( 'home/malotes/malotesEnviados' );
		$data ['URLLISTARUSU'] 			= site_url ( 'painel/usuario' );
		$data ['URLLISTAREMP'] 			= site_url ( 'painel/empresa' );
		$data ['BLC_DADOS'] 			= array ();
		$data ['BLC_SEMDADOS'] 			= array ();
		$data ['USERLOGADO'] 			= $this->session->userdata ( 'primeiroNome_usu' );
		
		$pagina = $this->input->get ( 'pagina' );
		
		if (! $pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina - 1) * LINHAS_PAGINA;
		}
		
		$res = $this->MaloteM->getMalote ( array (
				'usuarioDestino_malote' => $this->session->userdata ( 'id_usu' ) 
		), FALSE );
		
		$botao = "";
		
		if ($res) {
			foreach ( $res as $r ) {
				
				$usuEmp = $this->getUsuarioEmpresa ( $r->usuarioRemetente_malote );
				
				$fechado = "";
				
				if ($r->statusMalote == '2') {
					
					$botao = "<button onclick='visualizarMalote(" . $r->id_malote . ")'class='botao btn btn-info'>Visualizar</button>";
				} else {
					
					$botao = "<button onclick='receberMalote(" . $r->id_malote . ")'class='botao btn btn-success'>Receber</button>";
				}
				
				$status = $this->StatusM->getStatusMalote ( array (
						'id_statusMalote' => $r->statusMalote 
				), TRUE );
				
				$data ['BLC_DADOS'] [] = array (
						
						"id_malote" 				=> $r->id_malote,
						"usuarioRemetente_malote" 	=> $usuEmp ['nomeUsuario'],
						"empresaUsuario_malote" 	=> $usuEmp ['nomeEmpresa'],
						"dataEnvio_malote" 			=> $this->tratarDataHora ( $r->dataEnvio_malote ),
						"statusMalote" 				=> $status->descricao_statusMalote,
						"botaoReceber" 				=> $botao 
				);
			}
		} else {
			
			$data ['BLC_SEMDADOS'] [] = array ();
		}
		
		$this->parser->parse ( 'home/telas/list_malotesRecebidos', $data );
	}
	
	
	
	
	
	public function getUsuarioEmpresa($id_usuario) {
		$res = $this->UsuarioM->getUmUsuario ( $id_usuario );
		
		$emp = $this->EmpresaM->get ( array (
				'id_emp' => $res->id_emp 
		), TRUE );
		$r = array (
				'nomeUsuario' => $res->primeiroNome_usu,
				'nomeEmpresa' => $emp->nome_emp 
		);
		
		return $r;
	}
	
	
	
	
	
	public function gravarMalote() {
		$id_destinatario = $this->tratarDestinatario ( $this->input->post ( 'id_destinatario' ) );
		
		$dadosMalote ['id_malote'] 					= $this->input->post ( 'id_malote' );
		$dadosMalote ['usuarioRemetente_malote'] 	= $this->session->userdata ( 'id_usu' );
		$dadosMalote ['usuarioDestino_malote'] 		= $id_destinatario;
		$dadosMalote ['descricao_malote'] 			= $this->input->post ( 'descricao_malote' );
		$dadosMalote ['dataEnvio_malote'] 			= date ( "Y-m-d H:i:s" );
		$dadosMalote ['dataAtualizacao_malote'] 	= date ( "Y-m-d H:i:s" );
		$dadosMalote ['dataAbertura_malote'] 		= '';
		$dadosMalote ['statusMalote'] 				= '1';
		$dadosMalote ['fechado_malote'] 			= TRUE;
		
		$dataHora = date ( "Y-m-d H:i:s" );
		
		$ano 	= substr ( $dataHora, 0, - 15 );
		$mes 	= substr ( $dataHora, 5, - 12 );
		$dia 	= substr ( $dataHora, 8, - 9 );
		$hora 	= substr ( $dataHora, 10, - 6 );
		$min 	= substr ( $dataHora, 14, - 3 );
		
		if (! $this->input->is_ajax_request ()) {
			
			redirect ( '404' );
		} else {
			
			$this->atualizaMalote ( $dadosMalote );
			echo TRUE;
		}
	}
	
	
	
	
	
	public function listarItens($id_malote) {
		$resMalote = $this->MaloteM->getMalote ( array (
				'id_malote' 			=> $id_malote,
				'usuarioDestino_malote' => $this->session->userdata ( 'id_usu' ) 
		), TRUE );
		
		$resStatusMalote = $this->MaloteM->getStatusMalote ( array (
				'id_statusMalote' => $resMalote->statusMalote 
		), TRUE );
		
		$remetenteEmpresa = $this->getUsuarioEmpresa ( $resMalote->usuarioRemetente_malote );
		
		$dados = array ();
		$dados ['LEGENDAPAGINA'] 			= "Conferência de Malote";
		$dados ['DOCBUSCAR'] 				= "";
		$dados ['BOTAORODAPE'] 				= "<button class='btn btn-success' onclick='confirmarRecebimentoMalote()' type='button'>Receber Malote</button>";
		$dados ['URLLISTARMALOTES'] 		= site_url ( 'home/malotes' );
		$dados ['REMETENTEDESTINATARIO'] 	= 'Enviado';
		$dados ['MOSTRARMENUCADASTRO'] 		= $this->mostrarMenuCadastro ( $this->session->userdata ( 'nivelLogado' ) );
		$dados ['URLLISTAREMP'] 			= site_url ( 'painel/empresa' );
		$dados ['BLC_DADOS'] 				= array ();
		$dados ['BLC_SEMDADOS'] 			= array ();
		$dados ['USERLOGADO'] 				= $this->session->userdata ( 'primeiroNome_usu' );
		$dados ['id_malote'] 				= $id_malote;
		$dados ['descricao_malote']			= $resMalote->descricao_malote;
		$dados ['usuRemetente_malote'] 		= $this->getUsuarioEmpresa ( $resMalote->usuarioRemetente_malote )['nomeUsuario'];
		$dados ['empUsuario'] 				= $this->getUsuarioEmpresa ( $resMalote->usuarioRemetente_malote )['nomeEmpresa'];
		$dados ['statusMalote'] 			= $resStatusMalote->descricao_statusMalote;
		$dados ['dataEnvio_malote'] 		= $this->tratarDataHora ( $resMalote->dataEnvio_malote );
		$dados ['dataAbertura_malote'] 		= $this->tratarDataHora ( $resMalote->dataAbertura_malote );
		
		$res = $this->MaloteM->getItem ( array (
				'id_malote' => $id_malote 
		), FALSE );
		
		if ($res) {
			foreach ( $res as $r ) {
				
				$idItemForm = $id_malote . $r->id_seqItem;
				
				if ($r->id_statusItens == '2') {
					
					$checked = "checked";
				} else {
					
					$checked = "";
				}
				
				$dados ['BLC_DADOS'] [] = array (
						
						"id_seqItem" 			=> $r->id_seqItem,
						"descricao_item" 		=> $r->descricao_item,
						"identificacao_item" 	=> $r->identificacao_item,
						"botoes" 				=> "<label class='checkbox inline'>
										 <input " . $checked . " type='checkbox' id='" . $idItemForm . "'  class='btn btn-danger' onclick='checarItem(" . $id_malote . "," . $r->id_seqItem . "," . $idItemForm . ")'>
										 </label>" 
				);
			}
		} else {
			
			$dados ['BLC_SEMDADOS'] [] = array ();
		}
		
		$this->parser->parse ( 'home/telas/form_receberMalote', $dados );
	}
	
	
	
	
	
	// Visualiza os itens do lado do remetente
	public function visualizarItensRemetente($id_malote) {
		$resMalote = $this->MaloteM->getMalote ( array (
				'id_malote' 				=> $id_malote,
		), TRUE );
		
		
		
		$resStatusMalote = $this->MaloteM->getStatusMalote ( array (
				'id_statusMalote' => $resMalote->statusMalote 
		), TRUE );
		
		
		$remetenteEmpresa = $this->getUsuarioEmpresa ( $resMalote->usuarioRemetente_malote );
		
		$dados = array ();
		$dados ['LEGENDAPAGINA'] 			= "Detalhamento de Malote";
		$dados ['DOCBUSCAR'] 				= "";
		$dados ['BOTAORODAPE'] 				= "<button class='btn btn-success' onclick='listaMalotes()' type='button'>Voltar</button>";
		$dados ['URLLISTARMALOTES'] 		= site_url ( 'home/malotes' );
		$dados ['REMETENTEDESTINATARIO'] 	= "Destinatário";
		$dados ['MOSTRARMENUCADASTRO'] 		= $this->mostrarMenuCadastro ( $this->session->userdata ( 'nivelLogado' ) );
		$dados ['URLLISTAREMP'] 			= site_url ( 'painel/empresa' );
		$dados ['BLC_DADOS'] 				= array ();
		$dados ['BLC_SEMDADOS'] 			= array ();
		$dados ['USERLOGADO'] 				= $this->session->userdata ( 'primeiroNome_usu' );
		$dados ['id_malote'] 				= $id_malote;
		$dados ['descricao_malote'] 		= $resMalote->descricao_malote;
		$dados ['usuRemetente_malote'] 		= $this->getUsuarioEmpresa ( $resMalote->usuarioDestino_malote )['nomeUsuario'];
		$dados ['empUsuario'] 				= $this->getUsuarioEmpresa ( $resMalote->usuarioDestino_malote )['nomeEmpresa'];
		$dados ['statusMalote'] 			= $resStatusMalote->descricao_statusMalote;
		$dados ['dataEnvio_malote'] 		= $this->tratarDataHora ( $resMalote->dataEnvio_malote );
		$dados ['dataAbertura_malote'] 		= $this->tratarDataHora ( $resMalote->dataAbertura_malote );
		
		$res = $this->MaloteM->getItem ( array (
				'id_malote' => $id_malote 
		), FALSE );
		
		
		if ($res) {
			foreach ( $res as $r ) {
				
				$idItemForm = $id_malote . $r->id_seqItem;
				
				if ($r->id_statusItens == '2') {
					
					$checked = "checked";
				} else {
					
					$checked = "";
				}
				
				$dados ['BLC_DADOS'] [] = array (
						
						"id_seqItem" 			=> $r->id_seqItem,
						"descricao_item" 		=> $r->descricao_item,
						"identificacao_item" 	=> $r->identificacao_item,
						"botoes" 				=> "<label class='checkbox inline'>
										 <input disabled " . $checked . " type='checkbox' id='" . $idItemForm . "'  class='btn btn-danger' onclick='checarItem(" . $id_malote . "," . $r->id_seqItem . "," . $idItemForm . ")'>
											 </label>" 
				);
			}
		} else {
			
			$dados ['BLC_SEMDADOS'] [] = array ();
		}
		
		$this->parser->parse ( 'home/telas/form_receberMalote', $dados );
	}
	
	
	
	
	
	// Visualiza os itens do lado do destinatario
	public function visualizarItens($id_malote) {
		$resMalote = $this->MaloteM->getMalote ( array (
				'id_malote' 			=> $id_malote,
				'usuarioDestino_malote' => $this->session->userdata ( 'id_usu' ) 
		), TRUE );
		
		$resStatusMalote = $this->MaloteM->getStatusMalote ( array (
				'id_statusMalote' => $resMalote->statusMalote 
		), TRUE );
		
		$remetenteEmpresa = $this->getUsuarioEmpresa ( $resMalote->usuarioRemetente_malote );
		
		$dados = array ();
		$dados ['LEGENDAPAGINA'] 			= "Detalhamento de Malote";
		$dados ['DOCBUSCAR'] 				= "";
		$dados ['BOTAORODAPE'] 				= "<button class='btn btn-success' onclick='botaoListarRecebidos()' type='button'>Voltar</button>";
		$dados ['URLLISTARMALOTES'] 		= site_url ( 'home/malotes' );
		$dados ['REMETENTEDESTINATARIO'] 	= "Remetente";
		$dados ['MOSTRARMENUCADASTRO'] 		= $this->mostrarMenuCadastro ( $this->session->userdata ( 'nivelLogado' ) );
		$dados ['URLLISTAREMP'] 			= site_url ( 'painel/empresa' );
		$dados ['BLC_DADOS'] 				= array ();
		$dados ['BLC_SEMDADOS'] 			= array ();
		$dados ['USERLOGADO'] 				= $this->session->userdata ( 'primeiroNome_usu' );
		$dados ['id_malote'] 				= $id_malote;
		$dados ['descricao_malote'] 		= $resMalote->descricao_malote;
		$dados ['usuRemetente_malote'] 		= $this->getUsuarioEmpresa ( $resMalote->usuarioRemetente_malote )['nomeUsuario'];
		$dados ['empUsuario'] 				= $this->getUsuarioEmpresa ( $resMalote->usuarioRemetente_malote )['nomeEmpresa'];
		$dados ['statusMalote'] 			= $resStatusMalote->descricao_statusMalote;
		$dados ['dataEnvio_malote'] 		= $this->tratarDataHora ( $resMalote->dataEnvio_malote );
		$dados ['dataAbertura_malote'] 		= $this->tratarDataHora ( $resMalote->dataAbertura_malote );
		
		$res = $this->MaloteM->getItem ( array (
				'id_malote' => $id_malote 
		), FALSE );
		
		if ($res) {
			foreach ( $res as $r ) {
				
				$idItemForm = $id_malote . $r->id_seqItem;
				
				if ($r->id_statusItens == '2') {
					
					$checked = "checked";
				} else {
					
					$checked = "";
				}
				
				$dados ['BLC_DADOS'] [] = array (
						
						"id_seqItem" 			=> $r->id_seqItem,
						"descricao_item" 		=> $r->descricao_item,
						"identificacao_item" 	=> $r->identificacao_item,
						"botoes" 				=> "<label class='checkbox inline'>
								<input disabled " . $checked . " type='checkbox' id='" . $idItemForm . "'  class='btn btn-danger' onclick='checarItem(" . $id_malote . "," . $r->id_seqItem . "," . $idItemForm . ")'>
											 </label>" 
				);
			}
		} else {
			
			$dados ['BLC_SEMDADOS'] [] = array ();
		}
		
		$this->parser->parse ( 'home/telas/form_receberMalote', $dados );
	}
	
	
	
	
	
	// Altera o status do item para "Recusado"
	public function recusarItem() {
		if (! $this->input->is_ajax_request ()) {
			
			redirect ( '404' );
			
		} else {
			
			$dados ['id_malote'] 		= $this->input->post ( 'id_malote' );
			$dados ['id_seqItem'] 		= $this->input->post ( 'id_seqItem' );
			$status ['id_statusItens'] 	= '3';
			
			$this->MaloteM->atualizaItem ( $dados, $status );
		}
	}
	
	
	
	
	
	// Altera o status do item para "Recebido"
	public function receberItem() {
		if (! $this->input->is_ajax_request ()) {
			
			redirect ( '404' );
		} else {
			
			$dados ['id_malote'] 		= $this->input->post ( 'id_malote' );
			$dados ['id_seqItem'] 		= $this->input->post ( 'id_seqItem' );
			$status ['id_statusItens'] 	= '2';
			
			$this->MaloteM->atualizaItem ( $dados, $status );
		}
	}
	
	
	
	
	
	public function confirmarRecebimentoMalote() {
		if (! $this->input->is_ajax_request ()) {
			
			redirect ( '404' );
		} else {
			
			$idMalote = $this->input->post ( 'id_malote' );
			
			$res = $this->MaloteM->getItem ( array (
					'id_malote' => $idMalote 
			), FALSE );
			
			$maloteOK = 'SemPendencia';
			
			if ($res) {
				foreach ( $res as $r ) {
					
					if ($r->id_statusItens != '2') {
						
						$maloteOK = 'Pendente';
					}
				}
			}
			
			if ($maloteOK != 'SemPendencia') {
				
				$dados ['statusMalote'] = '3';
			} else {
				
				$dados ['statusMalote'] = '2';
			}
			$dados ['dataAbertura_malote'] = date ( "Y-m-d H:i:s" );
			
			$this->MaloteM->atualizaMalote ( $idMalote, $dados );
			
			echo "1";
		}
	}
	
	
	
	
	
	public function mostrarMenuCadastro($tipoUser) {
		if ($tipoUser == '1') {
			
			$menu = "<ul  class='nav'>
						<li class='dropdown'><a href='#' class='dropdown-toggle'
							data-toggle='dropdown'>Cadastro<b class='caret'></b></a>
							<ul class='dropdown-menu'>
								<li><a href='{URLLISTAREMP}' >Empresa</a></li>
								<li><a href='{URLLISTARUSU}' >Usuario</a></li>
							</ul>
						
					</ul>";
			
			return $menu;
		} else {
			
			return "";
		}
	}
	
	
	
	
	
	public function setURL() {
	
	}
	
	
	
	
	
	public function busca() {
		$itemBusca = $this->input->post ( 'busca' );
		
		// Botões
		$dados = array ();
		$dados ['BLC_DADOS'] 			= array ();
		$dados ['DOCBUSCAR'] 			= $itemBusca;
		$dados ['BLC_SEMDADOS'] 		= array ();
		$dados ['MOSTRARMENUCADASTRO'] 	= $this->mostrarMenuCadastro ( $this->session->userdata ( 'nivelLogado' ) );
		$dados ['URLLISTAREMP'] 		= site_url ( 'painel/empresa' );
		$dados ['URLLISTARUSU'] 		= site_url ( 'painel/usuario' );
		$dados ['USERLOGADO'] 			= $this->session->userdata ( 'primeiroNome_usu' );
		
		// Variáveis de tela
		$dados ['id_malote'] 				= '';
		$dados ['id_seqItem'] 				= '';
		$dados ['descricao_item'] 			= '';
		$dados ['identificacao_item'] 		= '';
		$dados ['id_malote'] 				= '';
		
		$idUsu = $this->session->userdata ( 'id_usu' );
		
		
		
		$res = $this->MaloteM->busca ( $itemBusca );
		
		if ($res) {
			foreach ( $res as $r ) {
				
				$resMalote = $this->MaloteM->getMalote ( array ('id_malote' => $r->id_malote), TRUE);
				
				//var_dump($resMalote);
				
				//die($resMalote->usuarioDestino_malote);	
				
				if($resMalote->usuarioDestino_malote == $idUsu or $resMalote->usuarioRemetente_malote == $idUsu){

					
				$dados ['BLC_DADOS'] [] = array (
						
						"id_seqItem" 			=> $r->id_seqItem,
						"descricao_item" 		=> $r->descricao_item,
						"identificacao_item"	=> $r->identificacao_item,
						"id_malote" 			=> "<a href='" . site_url('home/malotes/visualizarItensRemetente/') . "/". $r->id_malote . "' >" . $r->id_malote . "</a>"
				);
				}
			}
		} else {
			
			$dados ['BLC_SEMDADOS'] [] = array ();
			
		}
		
		$this->parser->parse ( 'home/telas/list_busca', $dados );
	}
	
	 	
	
	
	
	public function tratarDataHora($dataHora) {
		$ano 	= substr ( $dataHora, 0, - 15 );
		$mes 	= substr ( $dataHora, 5, - 12 );
		$dia 	= substr ( $dataHora, 8, - 9 );
		$hora 	= substr ( $dataHora, 10, - 6 );
		$min 	= substr ( $dataHora, 14, - 3 );
		$dataHoraTratada = $dia . "/" . $mes . "/" . $ano . " - " . $hora . ":" . $min;
		
		return $dataHoraTratada;
	}
}
	
		
		
	