<?php
$this->load->view ( 'painel/templates/header' );
?>
<div class="container-fluid well">
	<form id="form" action="{URLGRAVAR}" method="post" class="form-signin">
		<legend>
			Malote | {ACAO} <a href="{URLLISTARMALOTES}" title="Lista Malotes"
				class="btn pull-right"><i class="icon-th-list"></i> Listar</a>
		</legend>
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span2">
					<label>Cód.</label> <input name="id_malote" id="id_malote" type="text"
						class="span12" disabled value="{id_malote}">
				</div>
				<div class="span5">
					<label>Descrição<a class="asterisco">*</a></label> <input required="required" name="descricao_malote" id="descricao_malote"
						type="text" class="span12" maxlength="70" value="{descricao_malote}">
				</div>
				<div class="span5">
  						<label class="control-label" for="selectbasic">Destinatário<a class="asterisco">*</a></label>
  							<div class="controls">
  								 <select required="required" id="id_destinatario" name="id_destinatario" class="span12">
   									<option></option>
   									{BLC_USUARIOS}
   									<option {USUSELECIONADO}>{id_usu} - {destinatario_malote} - {empresa_destinatario}</option>
     								{/BLC_USUARIOS}
   								 </select>
							</div>
				</div>
			</div>
		</div>
			<hr class="linhaMalote">
			&nbsp
	<legend>
			Itens do Malote
		</legend>
			<div class="row-fluid">
				<div class="span5">
					<label>Descrição<a class="asterisco">*</a></label> <input required="required" name="descricao_item" id="descricao_item"
						type="text" class="span12" maxlength="70" value="">
				</div>
				
				<div class="span5">
					<label>Identificação<a class="asterisco">*</a></label> <input required="required" name="identificacao_item" id="identificacao_item"
						type="text" class="span12" maxlength="70" value="">
				</div>
				
				<div class="span2">
				<label class="control-label" for="selectbasic">&nbsp</label>
				
  				<button id="addItem" class="btn pull-right" onclick="adicionarItem()" type="button">Adicionar Item</button>
				</div>
			</div>
			<div class="table-responsive">
		  <table id="lista_itens" class="table table-hover table-bordered">
				<thead>
				<tr>
					  <th>Cód. Item</th>
					  <th>Descrição</th>
					  <th>Identificação</th>
					  <th class="actions"></th>
				</tr>
				</thead>
			  <tbody>
       
              </tbody>
           	<tfoot>
  
    		</tfoot>
		  </table>
		  	
			<button class="btn btn-success" onclick="enviarMalote()" type="button">Enviar Malote</button>
		</div>
 	</form>     
 	<div id="mensagem"></div>     
</div>
<?php
$this->load->view ( 'painel/templates/footer' );
?>