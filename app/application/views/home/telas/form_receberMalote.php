<?php
$this->load->view ( 'painel/templates/header' );
?>
<div class="container-fluid well">
	<form id="form" action="{URLGRAVAR}" method="post" class="form-signin">
		<legend>
			{LEGENDAPAGINA} <a href="{URLLISTARMALOTES}" title="Malotes Recebidos"
				class="btn pull-right"><i class="icon-th-list"></i> Listar</a>
		</legend>
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span2">
					<label>Cód.</label> <input name="id_malote" id="id_malote" type="text"
						class="span12" disabled value="{id_malote}">
				</div>
				<div class="span5">
					<label>Descrição<a class="asterisco"></a></label> <input disabled name="descricao_malote" id="descricao_malote"
						type="text" class="span12" maxlength="70" value="{descricao_malote}">
				</div>
				<div class="span5">
					<label>{REMETENTEDESTINATARIO}<a class="asterisco"></a></label> <input disabled name="usuRemetente_malote" id="usuRemetente_malote"
						type="text" class="span12" maxlength="70" value="{usuRemetente_malote} - {empUsuario}">
				</div>	
			</div>
		</div>
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span4">
					<label>Status Malote</label> <input name="statusMalote" id="statusMalote" type="text"
						class="span12" disabled value="{statusMalote}">
				</div>
				<div class="span4">
					<label>Enviado em:<a class="asterisco"></a></label> <input disabled name="dataEnvio_malote" id="dataEnvio_malote"
						type="text" class="span12" maxlength="70" value="{dataEnvio_malote}">
				</div>
				
				<div class="span4">
					<label>Recebido em:<a class="asterisco"></a></label> <input disabled name="dataAbertura_malote" id="dataAbertura_malote"
						type="text" class="span12" maxlength="70" value="{dataAbertura_malote}">
				</div>
				
			</div>
		</div>
			<hr class="linhaMalote">
			&nbsp
	<legend>
			Itens do Malote
		</legend>
			<div class="table-responsive">
		  <table id="lista_itens" class="table table-hover table-bordered">
				<thead>
				<tr>
					  <th class="itemCod">Cód. Item</th>
					  <th class="thDesc">Descrição</th>
					  <th class="thIdent">Identificação</th>
					  <th class="thStatus">Check</th>
				</tr>
				</thead>
			  <tbody>
              	{BLC_DADOS}
                <tr>
                  <td>{id_seqItem}</td>
                  <td>{descricao_item}</td>
                  <td>{identificacao_item}</td>
                  <td>{botoes}</td>
                </tr>
                {/BLC_DADOS}
                {BLC_SEMDADOS}
                <tr>
                  <td colspan="5" class="text-center">Não há dados...</td>
                </tr>
                {/BLC_SEMDADOS}
              </tbody>
           	<tfoot>
  
    		</tfoot>
		  </table>
			{BOTAORODAPE}
		</div>
 	</form>     
 	<div id="mensagem"></div>     
</div>
<?php
$this->load->view ( 'painel/templates/footer' );
?>