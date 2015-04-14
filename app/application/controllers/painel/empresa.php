<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Empresa extends CI_Controller{
	
	public function __construct(){
		
		parent::__construct();
		$this->load->model('Empresa_model', 'EmpresaM');
		#$this->load->model('Usuario_model', 'UsuarioM');
		
		$logado = $this->session->userdata ( 'logado' );
		$tipo	= $this->session->userdata ( 'nivelLogado'	);
		
		$testeAcesso = FALSE;
		
		if ($logado == '1') {
			
			$testeAcesso = TRUE;
			
		} else {
			
			$testeAcesso = FALSE;
			
		}
		
		if ($tipo == '1') {
			
			$testeAcesso = TRUE;
			
		} else {
						
			$testeAcesso = FALSE;
			
		}
		
		if ($logado){
			
			if($tipo != '1'){
				
			redirect ( site_url ( 'home/malotes' ) );

			}
			
			
			
		}
		
		if (!$testeAcesso) {
							
			redirect ( site_url ( 'login/login' ) );

			}
		}
	
	
	public function index(){

		
		$dados						= array();
		$dados['DOCBUSCAR'] 		= "";
		$dados['MOSTRARMENUCADASTRO'] 		= $this->mostrarMenuCadastro($this->session->userdata ( 'nivelLogado' ));
		$dados['URLFORMUSUARIO']	= site_url('painel/empresa/carregaFormulario');
		$dados['BLC_DADOS']			= array();
		$dados['BLC_SEMDADOS']		= array();
		$dados['USERLOGADO']		= $this->session->userdata('primeiroNome_usu');
		
		$pagina = $this->input->get('pagina');
		
		$this->setURL($dados);
		
		if (!$pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina - 1) * LINHAS_PAGINA;
		}
		
		$res = $this->EmpresaM->get(array(), FALSE, $pagina);
		
		if ($res) {
			foreach ($res as $r){
				$dados['BLC_DADOS'][] = array(
					
						"URLEXCLUIR"	=> site_url('painel/empresa/excluir/'. $r->id_emp),
						"URLEDITAR"		=> site_url('painel/empresa/prepAtualizar/'. $r->id_emp),
						"id_emp"		=> $r->id_emp,
						"nome_emp"		=> $r->nome_emp,
						"cnpj_emp"		=> $r->cnpj_emp,
						"insEst_emp"	=> $r->insEst_emp
				);
			}
			} else {
				
				$dados['BLC_SEMDADOS'][] = array();
			}
		
		$this->parser->parse('painel/telas/list_empresa', $dados);	
		
	}
	
	
	public function carregaFormulario(){
		
		#$this->layout = LAYOUT_DASHBOARD;
		
		$dados['MOSTRARMENUCADASTRO'] 		= $this->mostrarMenuCadastro($this->session->userdata ( 'nivelLogado' ));
		$dados ['DOCBUSCAR'] 				= "";
		$dados['ACAOFORM']					= site_url('painel/empresa/salvar');
		$dados['ACAO']						= 'Novo';
		$dados['URLLISTAREMP']				= site_url('painel/empresa');
		$dados['URLLISTAR']					= site_url('painel/empresa');
		$dados['USERLOGADO']				= $this->session->userdata('primeiroNome_usu');
		$dados['id_emp']					= NULL;
		$dados['nome_emp']					= '';
		$dados['cnpj_emp']					= '';
		$dados['insEst_emp']				= '';
		$dados['insMun_emp']				= '';
		$dados['nomeResp_emp']				= '';
		$dados['email_emp']					= '';
		$dados['tele_emp']					= '';
		$dados['logradouro_emp']			= '';
		$dados['numEnd_emp']				= '';
		$dados['compleEnd_emp']				= '';
		$dados['bairro_emp']				= '';
		$dados['cidade_emp']				= '';
		$dados['estado_emp']				= '';
		$dados['cep_emp']					= '';
			
		$this->setURL($dados);
		
		$this->parser->parse('painel/telas/form_empresa', $dados);
		
	}
	
	public function salvar(){
		
		
	#	$id_emp				= '';
		$nome_emp			= $this->input->post('nome_emp');
		$cnpj_emp			= $this->input->post('cnpj_emp');
		$insEst_emp			= $this->input->post('insEst_emp');
		$insMun_emp			= $this->input->post('insMun_emp');
		$nomeResp_emp		= $this->input->post('nomeResp_emp');
		$email_emp			= $this->input->post('email_emp');
		$logradouro_emp		= $this->input->post('logradouro_emp');
		$numEnd_emp			= $this->input->post('numEnd_emp');
		$compleEnd_emp		= $this->input->post('compleEnd_emp');
		$bairro_emp			= $this->input->post('bairro_emp');
		$cidade_emp			= $this->input->post('cidade_emp');
		$estado_emp			= $this->input->post('estado_emp');
		$cep_emp			= $this->input->post('cep_emp');
		
		$telefone = preg_replace('/[^0-9]/','',$this->input->post('tele_emp'));
		
		$itens		= array(
				"nome_emp"			=> $nome_emp,
				"cnpj_emp"			=> $cnpj_emp,
				"insEst_emp"		=> $insEst_emp,
				"insMun_emp"		=> $insMun_emp,
				"nomeResp_emp"		=> $nomeResp_emp,
				"email_emp"			=> $email_emp,
				"tele_emp"			=> $telefone,
				"logradouro_emp"	=> $logradouro_emp,
				"numEnd_emp"		=> $numEnd_emp,
				"compleEnd_emp"		=> $compleEnd_emp,
				"bairro_emp"		=> $bairro_emp,
				"cidade_emp"		=> $cidade_emp,
				"estado_emp"		=> $estado_emp,
				"cep_emp"			=> $cep_emp
		);
		
		
		$this->EmpresaM->post($itens);
		
		redirect('painel/empresa');
		
	}
	
	public function excluir($idEmpresa){
		
		$this->EmpresaM->delete($idEmpresa);
		
		redirect(site_url('painel/empresa'));
		
	}
	
	public function editar($param) {
		;
	}
	
	
	public function setURL(&$dados){
	
		$dados['URLLISTAREMP']	= site_url('painel/empresa');
		$dados['URLLISTARUSU']	= site_url('painel/usuario');
		
		
	
			
	
	}
	public function prepAtualizar($id_emp) {

		$this->load->model ( 'empresa_model', 'EmpresaM' );
	
	
		$data = array ();
		$data ['BLC_EMPRESASUSU'] 			= array ();
		
		$res = $this->EmpresaM->get ( array('id_emp' => $id_emp), TRUE );
	
	
		$data = array (
				"id_emp" 				=> $res->id_emp,
				"nome_emp" 				=> $res->nome_emp,
				"cnpj_emp" 				=> $res->cnpj_emp,
				"insEst_emp" 			=> $res->insEst_emp,
				"insMun_emp" 			=> $res->insMun_emp,
				"nomeResp_emp" 			=> $res->nomeResp_emp,
				"email_emp" 			=> $res->email_emp,
				"tele_emp" 				=> $res->tele_emp,
				"logradouro_emp" 		=> $res->logradouro_emp,
				"numEnd_emp" 			=> $res->numEnd_emp,
				"bairro_emp" 			=> $res->bairro_emp,
				"compleEnd_emp" 		=> $res->compleEnd_emp,
				"cidade_emp" 			=> $res->cidade_emp,
				"estado_emp" 			=> $res->estado_emp,
				"cep_emp" 				=> $res->cep_emp,
				"USERLOGADO" 			=> $this->session->userdata ( 'primeiroNome_usu' ),
				"ACAO"		 			=> 'Editar'
		);
		$data ['DOCBUSCAR'] 			= "";
		$data ['ACAOFORM'] 				= site_url('painel/empresa/atualizar/' . $res->id_emp);
		if($res->ativo == 1){
				
			$data['chk_usuarioDesativado'] = "checked='checked'";
				
		} else {
				
			$data['chk_usuarioDesativado'] = "";
	
		}
	
		$data ['MOSTRARMENUCADASTRO'] 		= $this->mostrarMenuCadastro($this->session->userdata ( 'nivelLogado' ));
		$data ['DESABILITADO']				= 'disabled';
		$this->setURL($data);
	
		$this->parser->parse ( 'painel/telas/form_empresa', $data );
	
	}
	
	public function atualizar($id_emp){
	
		if($this->input->post('desativado') == "S"){
	
			$desativado = 1;
	
		} else {
	
			$desativado = 0;
	
		}
		
		$data = array (
				"nome_emp" 				=> $this->input->post ( 'nome_emp' ),
				"cnpj_emp" 				=> $this->input->post ( 'cnpj_emp' ),
				"insEst_emp" 			=> $this->input->post ( 'insEst_emp' ),
				"insMun_emp" 			=> $this->input->post ( 'insMun_emp' ),
				"nomeResp_emp" 			=> $this->input->post ( 'nomeResp_emp' ),
				"email_emp" 			=> $this->input->post ( 'email_emp' ),
				"tele_emp" 				=> $this->input->post ( 'tele_emp' ),
				"logradouro_emp" 		=> $this->input->post ( 'logradouro_emp' ),
				"numEnd_emp" 			=> $this->input->post ( 'numEnd_emp' ),
				"bairro_emp" 			=> $this->input->post ( 'bairro_emp' ),
				"compleEnd_emp" 		=> $this->input->post ( 'compleEnd_emp' ),
				"cep_emp" 				=> $this->input->post ( 'cep_emp' ),
				"cidade_emp" 			=> $this->input->post ( 'cidade_emp' ),
				"estado_emp" 			=> $this->input->post ( 'estado_emp' ),
				"ativo" 				=> $desativado);

				
				$this->EmpresaM->update($id_emp, $data);
				
				redirect ( site_url ( 'painel/empresa' ) );
			
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
	
	
	
	