
//Função que adiciona linhas na tabela de itens
(function($) {
	
	

  RemoveTableRow = function(handler, id) {
    var tr = $(handler).closest('tr');
    id_malote = document.getElementById("id_malote").value;
    
    tr.fadeOut(400, function(){ 
      tr.remove(); 
    
      excluir_item(id_malote, id);
      
    
    }); 
    
    

    return false;
  };
  
  
  var seq = 1;
  var id_malote = "";
  var descricao = "";
  var identificacao = "";
  
  adicionarItem = function() {
	  
		if(document.getElementById("descricao_item").value){
			
			if(document.getElementById("identificacao_item").value){
				  var newRow = $("<tr>");
			      var cols = "";
			      
			      id_malote = document.getElementById("id_malote").value;
			      descricao = document.getElementById("descricao_item").value;
			      identificacao = document.getElementById("identificacao_item").value;
			      
			      cols += '<td>' + seq + '</td>';
			      cols += '<td>' + descricao + '</td>';
			      cols += '<td>' + identificacao + '</td>';
			      cols += '<td class="acao">';
			      cols += '<button id="' + seq + '"  class="btn btn-danger" onclick="RemoveTableRow(this, this.id)" type="button">Remover</button>';
			      cols += '</td>';
			      
			      inserir_registo(seq, id_malote, descricao, identificacao);

			      seq++;
			      
			      newRow.append(cols);
			      
			      $("#lista_itens").append(newRow);
			    
			      
			      
			     
			      document.getElementById("descricao_item").value = '';
			      document.getElementById("identificacao_item").value = '';
			      return false;
				
				
				
			}
			
		}  
  };
  
  
  
})(jQuery);


function inserir_registo(seq, id_malote, descricao, identificacao){
		 
	    //dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
	    var dadosajax = {
    		'id_malote' 			: id_malote,
    		'id_seqItem' 			: seq,
    		'descricao_malote' 		: document.getElementById("descricao_malote").value,
	    	'id_destinatario'		: document.getElementById("id_destinatario").value,		
	        'descricao' 			: descricao,
	        'identificacao' 		: identificacao
	    };
	    
	    //para consultar mais opcoes possiveis numa chamada ajax
	    //http://api.jquery.com/jQuery.ajax/
	    $.ajax({
	 
	        //url da pagina
	        url: 'incluirItem',
	        //parametros a passar
	        data: dadosajax,
	        //tipo: POST ou GET
	        type: 'POST',
	        //cache
	        cache: false,
	        //se ocorrer um erro na chamada ajax, retorna este alerta
	        //possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
	        error: function(){
	            alert('Erro: Inserir Registo!!');
	        },
	        //retorna o resultado da pagina para onde enviamos os dados
	        success: function(result)
	        { 
	            //se foi inserido com sucesso
	            if($.trim(result) == '1')
	            {
					alert("O seu registo foi inserido com sucesso!");
	            }
	            //se foi um erro
	            else
	            {
	                alert("Ocorreu um erro ao inserir o seu registo!");
	            }
	 
	        }
	    });
	}
	  	

function excluir_item(id_malote, itemExcluir){
	 
    //dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
    var dadosajax = {		
        'id_malote' 	: id_malote,
        'id_seqItem' 	: itemExcluir,
    };
    
    //para consultar mais opcoes possiveis numa chamada ajax
    //http://api.jquery.com/jQuery.ajax/
    $.ajax({
 
        //url da pagina
        url: "excluirItem",
        //parametros a passar
        data: dadosajax,
        //tipo: POST ou GET
        type: 'POST',
        //cache
        cache: false,
        //se ocorrer um erro na chamada ajax, retorna este alerta
        //possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
        error: function(){
            alert('Erro ao excluir registo!!');
        },
        //retorna o resultado da pagina para onde enviamos os dados
        success: function(result)
        { 
            //se foi inserido com sucesso
            if($.trim(result) == '1')
            {
				alert("O seu registo foi excluido com sucesso!");
            }
            //se foi um erro
            else
            {
                alert("Ocorreu um erro ao remover o seu registo!");
            }
 
        }
    });
}


function enviarMalote() {
	  
    var dadosajax = {
    		'id_malote'				: document.getElementById("id_malote").value,
    		'descricao_malote' 		: document.getElementById("descricao_malote").value,
	    	'id_destinatario'		: document.getElementById("id_destinatario").value,		
	    };
	    
	    //para consultar mais opcoes possiveis numa chamada ajax
	    //http://api.jquery.com/jQuery.ajax/
	    $.ajax({
	 
	        //url da pagina
	        url: 'gravarMalote',
	        //parametros a passar
	        data: dadosajax,
	        //tipo: POST ou GET
	        type: 'POST',
	        //cache
	        cache: false,
	        //se ocorrer um erro na chamada ajax, retorna este alerta
	        //possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
	        error: function(){
	            alert('Erro: Inserir Registo!!');
	        },
	        //retorna o resultado da pagina para onde enviamos os dados
	        success: function(result)
	        { 
	            //se foi inserido com sucesso
	            if($.trim(result) == '1')
	            {
					
	            	alert("Malote enviado com sucesso!");
	            	var novaURL = 'malotes';
	            	$(window.document.location).attr('href',novaURL);
					
	            }
	            //se foi um erro
	            else
	            {
	                alert("Êita mah... Deu erro ó! :/");
	            }
	 
	        }
	    });
	}


function confirmarRecebimentoMalote() {
	
	window.history.pushState("", "Fast Protocol", "http://127.0.0.1:81/fastprotocol/index.php/home/malotes/");
	  
    var dadosajax = {
    		'id_malote'				: document.getElementById("id_malote").value	
	    };
	    
		
	    //para consultar mais opcoes possiveis numa chamada ajax
	    //http://api.jquery.com/jQuery.ajax/
	    $.ajax({
	 
	        //url da pagina
	        url: 'confirmarRecebimentoMalote',
	        //parametros a passar
	        data: dadosajax,
	        //tipo: POST ou GET
	        type: 'POST',
	        //cache
	        cache: false,
	        //se ocorrer um erro na chamada ajax, retorna este alerta
	        //possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
	        error: function(){
	            alert('Erro: Inserir Registo!!');
	        },
	        //retorna o resultado da pagina para onde enviamos os dados
	        success: function(result)
	        { 
	            //se foi inserido com sucesso
	            if($.trim(result) == '1')
	            {
					
	                alert('Malote Recebido com Sucesso');

					window.location.replace("http://127.0.0.1:81/fastprotocol/index.php/home/malotes");
					
	            }
	            //se foi um erro
	            else
	            {
	                alert('Erro');
	            }
	 
	        }
	    });
	}

 function receberMalote(id) {
 			
		   	var URLlistarItens = 'malotes/listarItens/' + id;
			$(window.document.location).attr('href',URLlistarItens);
	
	
  };
  
  function checarItem(id_malote, id_item, idElementoForm){
	
	window.history.pushState("", "Fast Protocol", "http://127.0.0.1:81/fastprotocol/index.php/home/malotes/");
	
	var idElemento = document.getElementById(idElementoForm).checked;
	var acaoItem = "";
	
	if (idElemento) {
    
				acaoItem = 'receberItem';
	
	} else {
    
				acaoItem = 'recusarItem';
	
	
	};
	
	var dadosajax = {
    		'id_malote'		: id_malote,
    		'id_seqItem' 	: id_item,		
	    };
	    
	    //para consultar mais opcoes possiveis numa chamada ajax
	    //http://api.jquery.com/jQuery.ajax/
	    $.ajax({
	 
	        //url da pagina
	        url: acaoItem,
	        //parametros a passar
	        data: dadosajax,
	        //tipo: POST ou GET
	        type: 'POST',
	        //cache
	        cache: false,
	        //se ocorrer um erro na chamada ajax, retorna este alerta
	        //possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
	        error: function(){
	            alert('Erro: Inserir Registo!!');
	        },
	        //retorna o resultado da pagina para onde enviamos os dados
	        success: function(result)
	        { 
	           
	 
	        }
	    });
	
  }
  
  
   function visualizarMalote(id) {
 			
		   	//var URLlistarItens = 'malotes/visualizarItens/' + id;
  			window.location.assign('http://127.0.0.1:81/fastprotocol/index.php/home/malotes/visualizarItens/' + id);
			//$(window.document.location).attr('href',URLlistarItens);
	
	
  };
  
   function visualizarMaloteRemetente(id) {
 			
		   	//var URLlistarItens = 'malotes/visualizarItens/' + id;
  			window.location.assign('http://127.0.0.1:81/fastprotocol/index.php/home/malotes/visualizarItensRemetente/' + id);
			//$(window.document.location).attr('href',URLlistarItens);
	
	
  };
  
  function listaMalotes(){
  	
  	window.location.assign("http://127.0.0.1:81/fastprotocol/index.php/home/malotes/");
	//window.location.reload(false);
  	
  }
  
  function listaEmpresas(){
  	
  	window.location.assign("http://127.0.0.1:81/fastprotocol/index.php/painel/empresa");
	//window.location.reload(false);
  	
  }
  
  
  function confirmarExclusao() {
                if (confirm("Tem certeza que deseja excluir?"))
                    return true;
                else
                    return false;
   }
			
			
  function ConfirmarGravacao(){
  		 if (confirm("Confirma Gravação?"))
                    return true;
                else
                    return false;
  }
  
  
  function botaoListarRecebidos(){
  	
  	window.location.assign("http://127.0.0.1:81/fastprotocol/index.php/home/malotes/");
	//window.location.reload(false);
  	
  }
  
  