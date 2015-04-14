$(function() { 
//When the DOM is ready, we disable the matches list
 $('select#match_list').attr('disabled',true);
 });




function activate_match()
{
var tnmt_id = $('select#tournament_list').val(); //Get the id of the tournament selected in the list
$.ajax({
type: 'POST',
url: '<?php echo base_url(); ?>index.php/match/list_dropdown', 
data: 'tnmnt='+ tnmt_id, 
success: function(resp) { 


}
});
}

function confirmaExclusao() {
	
	if(Window.confirm("Tem certeza que deseja excluir?")){
		
		Location.href("{URLEXCLUIR}");
		
	}
		
}

function adicionarItem(){
	
	
	var descricao = null;
	var identificacao = null;
	
	descricao = window.document.getElementByName('descricao_malote').value;
	identificacao = window.document.getElementByName('identificacao_malote').value;
	
	
	
	
	
}




