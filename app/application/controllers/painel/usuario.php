<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * 
 * @author helder
 *
 */
class Usuario extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'Usuario_model', 'UsuarioM' );
		
		$logado = $this->session->userdata ( 'logado' );
		$tipo	= $this->session->userdata ( 'tipoUsuario'	);
		if ($logado != 1 and $tipo != 1) {
				
			redirect ( site_url ( 'login/login' ) );
	
		}
		
	}
	
	
	
	#
	#Lista todos os usuários
	#
	public function index() {
		
		$this->load->model ( 'empresa_model', 'EmpresaM' );
		
		$data = array ();
		$data ['DOCBUSCAR'] 			= "";
		$data ['MOSTRARMENUCADASTRO'] 		= $this->mostrarMenuCadastro($this->session->userdata ( 'nivelLogado' ));
		$data ['URLFORMUSUARIO'] 	= site_url ( 'painel/usuario/prepGravar' );
		$data ['BLC_DADOS'] 		= array ();
		$data ['BLC_SEMDADOS'] 		= array ();
		$data ['USERLOGADO'] 		= $this->session->userdata ( 'primeiroNome_usu' );
		
		$this->setURL ( $data );
		
		$pagina = $this->input->get ( 'pagina' );
		
		if (! $pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina - 1) * LINHAS_PAGINA;
		}
		
		$res = $this->UsuarioM->get ( array (), FALSE, $pagina );
		
		if ($res) {
			foreach ( $res as $r ) {
				$data ['BLC_DADOS'] [] = array (
						
						"id_usu" => $r->id_usu,
						"primeiroNome_usu" => $r->primeiroNome_usu,
						"ultimoNome_usu" => $r->ultimoNome_usu,
						"login_usu" => $r->login_usu,
						"nome_emp" => $this->EmpresaM->listarEmpUsuario ( $r->id_emp )->nome_emp,
						"URLEXCLUIR" => site_url ( 'painel/usuario/excluir/' . $r->id_usu ),
						"URLEDITAR" => site_url ( 'painel/usuario/prepAtualizar/' . $r->id_usu ) 
				);
			}
		} else {
			
			$data ['BLC_SEMDADOS'] [] = array ();
		}
		
		$this->parser->parse ( 'painel/telas/list_usuario', $data );
	}
	
	
	
	#
	#Prepara o formulário de cadastro para receber um novo usuário
	#
	public function prepGravar() {
		
		$dados ['DOCBUSCAR'] 					= "";
		$dados ['MOSTRARMENUCADASTRO'] 			= $this->mostrarMenuCadastro($this->session->userdata ( 'nivelLogado' ));
		$dados ['BLC_EMPRESASUSU'] 				= array ();
		$dados ['BLC_TIPOUSUARIO'] 				= array ();
		$dados ['MENUUSUARIO'] 					= '';
		$dados ['USERLOGADO'] 					= $this->session->userdata ( 'primeiroNome_usu' );
		$dados ['ACAO']							= 'Novo';						
		$dados ['URLGRAVAR']					= site_url('painel/usuario/gravar');						
		$dados ['id_usu'] 						= '';
		$dados ['primeiroNome_usu'] 			= '';
		$dados ['ultimoNome_usu'] 				= '';
		$dados ['login_usu'] 					= '';
		$dados ['email_usu'] 					= '';
		$dados ['tele_usu'] 					= '';
		$dados ['dataCad_usu'] 					= time ();
		$dados ['chk_usuarioDesativado'] 		= '';
		
		$this->setURL ( $dados );
		
		$this->load->model ( 'empresa_model', 'EmpresaM' );
		$res = $this->EmpresaM->get ( array () );
		
		if ($res) {
			foreach ( $res as $r ) {
				$dados ['BLC_EMPRESASUSU'] [] = array (
						
						"id_emp" => $r->id_emp,
						"nome_emp" => $r->nome_emp 
				);
			}
		} else {
			
			$dados ['BLC_SEMDADOS'] [] = array ();
		}
		
		$tiposUsuario = $this->UsuarioM->getTipoUsuario();
		
		if ($tiposUsuario) {
			foreach ( $tiposUsuario as $t ) {
				$dados ['BLC_TIPOUSUARIO'] [] = array (
		
						"id_tipoUsuario" => $t->id_tipoUsuario,
						"descricao_tipoUsuario" => $t->descricao_tipoUsuario
				);
			}
		}
		
		
		$this->parser->parse ( 'painel/telas/form_usuario', $dados );
		
	}
	
	
	
	#
	#Função que inclui o novo usuário no banco de dados.
	#
	public function gravar() {
	
		$telefone = preg_replace('/[^0-9]/','',$this->input->post ( 'tele_usu' ));
	
		if ($this->input->post ( 'desativado' ) == "S") {
				
			$desativado = 1;
			
		} else {
				
			$desativado = 0;
		}
			
		$itens = array (
	
				'primeiroNome_usu'		=> $this->input->post ( 'primeiroNome_usu' ),
				'ultimoNome_usu' 		=> $this->input->post ( 'ultimoNome_usu' ),
				'id_emp' 				=> $this->input->post ( 'id_emp' ),
				'login_usu' 			=> $this->input->post ( 'login_usu' ),
				'senha_usu' 			=> $this->encrypt->sha1 ( $this->input->post ( 'senha_usu' ) ),
				'email_usu' 			=> $this->input->post ( 'email_usu' ),
				'tele_usu' 				=> $telefone,
				'dataCad_usu' 			=> $this->input->post ( 'dataCad_usu' ),
				'id_tipoUsuario' 		=> $this->input->post ( 'id_tipoUsuario' ),
				'desativado'			=> $desativado
	
		);
	
		$this->UsuarioM->insert ( $itens );
		redirect ( site_url ( 'painel/usuario' ) );
	
	}
	
	
	
	#
	#Carrega os dados no formulário de um usuário escolhido na lista para ser editado. 
	#
	public function prepAtualizar($id_usu) {
		$this->load->model ( 'empresa_model', 'EmpresaM' );
		
		$resEmp = $this->EmpresaM->get ( array () );
		
		$data = array ();
		$data ['BLC_EMPRESASUSU'] 			= array ();
		$data ['SELECIONADO'] 				= '';
		$dados ['id_usu'] 					= $id_usu;
		
		$res = $this->UsuarioM->get ( $dados, TRUE );
		
		$empresa = $res->id_emp;
		$tiposUsuario = $res->id_tipoUsuario;
		
		$data = array (
				
				"id_usu" 			=> $res->id_usu,
				"primeiroNome_usu" 	=> $res->primeiroNome_usu,
				"ultimoNome_usu" 	=> $res->ultimoNome_usu,
				"tele_usu" 			=> $res->tele_usu,
				"email_usu" 		=> $res->email_usu,
				"login_usu" 		=> $res->login_usu,
				"dataCad_usu" 		=> $res->dataCad_usu,
				"USERLOGADO" 		=> $this->session->userdata ( 'primeiroNome_usu' ), 
				"ACAO"		 		=> 'Editar' 
		);	
		$data ['MOSTRARMENUCADASTRO'] 		= $this->mostrarMenuCadastro($this->session->userdata ( 'nivelLogado' ));
		$data ['URLFORMUSUARIO'] 			= site_url ( 'painel/usuario/prepGravar' );
		
		if($res->desativado == 1){
			
			$data['chk_usuarioDesativado'] = "checked='checked'";
			
		} else {
			
			$data['chk_usuarioDesativado'] = "";
						
		}
		
		$data ['DESABILITADO']				= 'disabled';
		$data ['URLGRAVAR'] 				= site_url('painel/usuario/atualizar/' . $res->id_usu);
		
		$selecionadoEmp = NULL;
		$selecionadoTU = NULL;
		
		if ($resEmp) {
			foreach ( $resEmp as $r ) {
				
				if ($r->id_emp == $empresa) {
					
					$selecionadoEmp = 'selected="selected"';
				} else {
					
					$selecionadoEmp = '';
				}
				
				$data ['BLC_EMPRESASUSU'] [] = array (
						
						"id_emp" 		=> $r->id_emp,
						"nome_emp" 		=> $r->nome_emp,
						"SELECIONADOEMP" 	=> $selecionadoEmp 
				);
			}
		}
		
		
		$tU = $this->UsuarioM->getTipoUsuario();
		
		if ($tU) {

			foreach ( $tU as $t ) {
				
				if($t->id_tipoUsuario == $tiposUsuario ){
					
					$selecionadoTU = 'selected="selected"';
					
				} else {
					
					$selecionadoTU = '';
				}
				
				
				$data ['BLC_TIPOUSUARIO'] [] = array (
		
						"id_tipoUsuario" => $t->id_tipoUsuario,
						"descricao_tipoUsuario" => $t->descricao_tipoUsuario,
						"SELECIONADOTU" 		=> $selecionadoTU
				);
			}
		} else {
		
			$data ['DOCBUSCAR'] 		= "";
			$data ['BLC_SEMDADOS'] [] 	= array ();
		}
			
		$this->setURL ( $data );
		$this->parser->parse ( 'painel/telas/form_usuario', $data );
		
	}
	
	
	
	#
	#Grava a alteração feita em um usuário já cadastrado
	#
	public function atualizar($id_usu){
		
		if($this->input->post('desativado') == "S"){
		
			$desativado = 1;
		
		} else {
		
			$desativado = 0;
		
		}
		
		$itens = array(
				'primeiroNome_usu'		=> $this->input->post ( 'primeiroNome_usu' ),
				'ultimoNome_usu' 		=> $this->input->post ( 'ultimoNome_usu' ),
				'id_emp' 				=> $this->input->post ( 'id_emp' ),
				'id_tipoUsuario' 		=> $this->input->post ( 'id_tipoUsuario' ),
				'email_usu' 			=> $this->input->post ( 'email_usu' ),
				'tele_usu' 				=> $this->input->post ( 'tele_usu' ),
				'desativado'			=> $desativado
				
		);
		
		$this->UsuarioM->update($id_usu, $itens);
		
		redirect ( site_url ( 'painel/usuario' ) );
			
	}
	
	
	
	#
	#Função exclui usuário escolhido na lista de usuários
	#
	public function excluir($id) {
		$res = $this->UsuarioM->delete ( $id );
		
		if ($res) {
			$this->session->flashdata ( 'sucesso', 'Usuário excluido com sucesso.' );
		} else {
			
			$this->session->flashdata ( 'erro', 'Algo de errado aconteceu! O registro não foi removido' );
		}
		redirect ( site_url ( 'painel/usuario' ) );
	}
	
	
	
	#
	#Função encerra a sessão de usuário
	#
	public function logoff() {
		$this->session->sess_destroy ();
		
		redirect ( site_url ( 'login/login' ) );
	}
	
	
	
	#
	#Função para inserir URLs
	#
	public function setURL(&$dados) {
		$dados ['URLLISTAREMP'] = site_url ( 'painel/empresa' );
		$dados ['URLLISTARUSU'] = site_url ( 'painel/usuario' );

	}
	
public function mostrarMenuCadastro($tipoUser){
		
	if($tipoUser == '1'){
		
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
}	