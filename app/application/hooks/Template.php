<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );


class Template {
	
	/**
	 */
	public function init(){
		
		//Pega a inst�cia que est� rodando no codeigniter
		$CI		= &get_instance();
		
		//Pega o que est� sendo exibido
		$output	= $CI->output->get_output();
		
		//Verifica se layout foi definido
		//1� if
		if(isset($CI->layout)){
			
			//Verifica se o layout � diferente de falso
			//2� if
			if($CI->layout){
							
				//Verifica se o arquivo tem extenss�o .php
				//3� if
				if(!preg_match('/(.+).php$/', $CI->layout)){

					//Caso o arquivo n�o tenha a extenss�o .php ele adiciona 
					$CI->layout .= '.php';
					
				}//end 3� if
				
				//Define a pasta da Template
				$template = APPPATH . 'templates/'.$CI->layout;
				
				//Verifica de o arquivo existe na pasta
				//5� if
				if(file_exists($template)){

					//
					$layout = $CI->load->file($template, TRUE);
					
				} else {  //end 5� if
 				
					die('Template inválida.');	
					
				}
				
				$html = str_replace("{CONTEUDO}", $output, $layout);
				
			} else {//end 2� if 
			
				$html = $output;
				
			}	
		} else { //end 1� if	
		
			$html = $output;	
			
		}
		
		$CI->output->_display($html);
	}
	
}