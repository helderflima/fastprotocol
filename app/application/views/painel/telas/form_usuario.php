<?php
$this->load->view ( 'painel/templates/header' );
?>

<div class="container-fluid well">
	<form action="{URLGRAVAR}" method="post" class="form-signin">
		<legend>
			Cadastro de Usuário | {ACAO} <a href="{URLLISTARUSU}" title="Lista usuários"
				class="btn pull-right"><i class="icon-th-list"></i> Listar</a>
		</legend>
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span2">
					<label>Cód.</label> <input name="id_usu" id="id_usu" type="text"
						class="span12" disabled value="{id_usu}">
				</div>
				<div class="span3">
					<label>Primeiro nome<a class="asterisco">*</a></label> <input required="required" name="primeiroNome_usu" id="primeiroNome_usu"
						type="text" class="span12" maxlength="70" value="{primeiroNome_usu}">
				</div>
				<div class="span3">
					<label>Último nome<a class="asterisco">*</a></label> <input required="required" name="ultimoNome_usu" id="ultimoNome_usu"
						type="text" class="span12" maxlength="70" value="{ultimoNome_usu}">
				</div>
				<div class="span4">
  						<label class="control-label" for="selectbasic">Empresa<a class="asterisco">*</a></label>
  							<div class="controls">
  								 <select required="required" id="id_emp" name="id_emp" class="span12">
   									<option></option>
   									{BLC_EMPRESASUSU}
   									<option {SELECIONADOEMP} value="{id_emp}">{nome_emp}</option>
     								{/BLC_EMPRESASUSU}
   								 </select>
							</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span2">
					<label>Login<a class="asterisco">*</a></label> <input required="required" name="login_usu" id="login_usu"
						type="text" class="span12" value="{login_usu}">

				</div>
				<div class="span2">
  						<label class="control-label" for="selectbasic">Tipo de Usuário<a class="asterisco">*</a></label>
  							<div class="controls">
  								 <select required="required" id="id_tipoUsuario" name="id_tipoUsuario" class="span12">
   									<option></option>
   									{BLC_TIPOUSUARIO}
   									<option {SELECIONADOTU} value="{id_tipoUsuario}">{descricao_tipoUsuario}</option>
     								{/BLC_TIPOUSUARIO}
   								 </select>
							</div>
				</div>
				<div class="span5">
					<label>E-mail<a class="asterisco">*</a></label> <input required="required" name="email_usu"
						id="email_usu" type="email" class="span12" value="{email_usu}">

				</div>
				<div class="span3">
					<label>Telefone<a class="asterisco">*</a></label> <input required="required" name="tele_usu"
						id="tele_usu" type="text" class="span12" value="{tele_usu}">
				</div>
			</div>
			<hr>
			<div class="row-fluid">
				<div class="span2">
					<label>Senha<a class="asterisco">*</a></label> <input {DESABILITADO} name="senha_usu" id="senha_usu"
						type="password" class="span12" value="">

				</div>
				<div class="span2">
					<label>Confirmar Senha<a class="asterisco">*</a></label> <input {DESABILITADO} name="confEmail_usu"
						id="confEmail_usu" type="password" class="span12" value="">

				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					
					<button onclick="ConfirmarGravacao()" type="submit" class="btn">Gravar</button>
				
				
				
				</div>
			</div>
			&nbsp;
			<div class="row-fluid">
				<div class="span12">
					<label class="checkbox"> <input type="checkbox" name="desativado" id="desativado" value="S" {chk_usuarioDesativado}>Desativado
					</label>
				</div>
			</div>
		</div>
	</form>
</div>

<?php
$this->load->view ( 'painel/templates/footer' );
?>