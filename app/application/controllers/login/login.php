<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class login extends CI_Controller{
	
	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Usuario_model', 'UsuarioM');
	}
	
	public function index(){
		
		$data					= array();
		$data['login_usu']		= $this->input->post('login_usu');
		$data['senha_usu']		= $this->input->post('senha_usu');
		
		
		$this->parser->parse('login/form_login', $data);
		
		
	}	
	

	public function logar() {
	
		$login_usu				= $this->input->post('login_usu');
		$senha					= $this->input->post('senha_usu');
		$senhaCript				= $this->encrypt->sha1($senha);
		$dadosUsu 				= $this->UsuarioM->get(array('login_usu' => $login_usu, 'senha_usu' => $senhaCript), TRUE);
		$id_usu					= $dadosUsu->id_usu;
		$primeiroNome_usu		= $dadosUsu->primeiroNome_usu;
		$tipoUsuario			= $dadosUsu->id_tipoUsuario;
		$desativado				= $dadosUsu->desativado;
		$logado 				= FALSE;

		#die($desativado);
		
		if ($dadosUsu && $desativado == '0') {
			
			$nivel = '2';
			
			if ($tipoUsuario == '1') {
				
				$nivel = '1';
				
			}
				
			$logado = TRUE;
			
	    }
		
		
		
		if($logado){
			
			$sessao = array(
					'id_usu' => $id_usu,
					'primeiroNome_usu' => $primeiroNome_usu,
					'login_usu'  => $login_usu,
					'logado' => $logado,
					'nivelLogado' => $tipoUsuario,
			);
			
			#die($nivel);
			$this->session->set_userdata($sessao);
			
			if ($nivel != 1) {
				
			     	redirect(site_url('home/malotes'));

			} else {
			
			   		redirect(site_url('painel/empresa'));
					
			}
		} 
				
		redirect(site_url('login/login'));
		echo 'Tente novamente!';
		
				#$this->session->set_userdata($data);
				#redirect('painel/painel');	
	}
}