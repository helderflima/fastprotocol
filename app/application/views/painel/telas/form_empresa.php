<?php
$this->load->view ( 'painel/templates/header' );
?>

<div class="container-fluid well">
		<legend>
			Cadastro Empresa | {ACAO}  <button onclick="listaEmpresas()" title="Listar Empresas"
				class="btn pull-right"><i class="icon-th-list"></i> Listar</button>
		</legend>
		<form action="{ACAOFORM}" method="post" class="form-signin">
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span2">
					<label>Cód.<a class="asterisco">*</a></label> <input required name="id_emp" id="id_emp" type="text"
						class="span12" disabled value="{id_emp}">
				</div>
				<div class="span10">
					<label>Razão Social<a class="asterisco">*</a></label> <input required name="nome_emp" id="nome_emp"
						type="text" class="span12" maxlength="70" value="{nome_emp}">
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span4">
					<label>CNPJ<a class="asterisco">*</a></label> <input required name="cnpj_emp" id="cnpj_emp"
						type="text" class="span12" value="{cnpj_emp}">

				</div>
				<div class="span4">
					<label>Insc. Estadual<a class="asterisco">*</a></label> <input required name="insEst_emp"
						id="insEst_emp" type="text" class="span12" value="{insEst_emp}">

				</div>
				<div class="span4">
					<label>Insc. Municipal<a class="asterisco">*</a></label> <input required name="insMun_emp"
						id="insMun_emp" type="text" class="span12" value="{insMun_emp}">
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span4">
					<label>Responsável<a class="asterisco">*</a></label> <input required name="nomeResp_emp"
						id="nomeResp_emp" type="text" class="span12"
						value="{nomeResp_emp}">
				</div>
				<div class="span6">
					<label>Email<a class="asterisco">*</a></label> <input required name="email_emp" id="email_emp"
						type="email" class="span12" value="{email_emp}">

				</div>
				<div class="span2">
					<label>Telefone<a class="asterisco">*</a></label> <input required name="tele_emp" id="tele_emp"
						type="text" class="span12" value="{tele_emp}">
				</div>
			</div>
		</div>
		<hr>
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="span7">
					<label>Endereço<a class="asterisco">*</a></label> <input required name="logradouro_emp"
						id="logradouro_emp" type="text" class="span12"
						placeholder="Logradouro" value="{logradouro_emp}">
				</div>
				<div class="span2">
					<label>&nbsp;</label> <input required name="numEnd_emp" id="numEnd_emp"
						type="text" class="span12" placeholder="Número"
						value="{numEnd_emp}">
				</div>
				<div class="span3">
					<label>&nbsp;</label> <input required name="bairro_emp" id="bairro_emp"
						type="text" class="span12" placeholder="Bairro"
						value="{bairro_emp}">
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<input name="compleEnd_emp" id="compleEnd_emp" type="text"
						class="span12" placeholder="Compremento" value="{compleEnd_emp}">
				</div>
				<div class="span3">
					<input required name="cidade_emp" id="cidade_emp" type="text" class="span12"
						placeholder="Cidade" value="{cidade_emp}">
				</div>
				<div class="span3">
					<input required name="estado_emp" id="estado_emp" type="text" class="span12"
						placeholder="Estado" value="{estado_emp}">

				</div>
				<div class="span2">
					<input required name="cep_emp" id="cep_emp" type="text" class="span12"
						placeholder="CEP" value="{cep_emp}">
				</div>
			</div>
			&nbsp;
			<div class="row-fluid">
				<div class="span12">

					<button onclick="ConfirmarGravacao()" type="submit" class="btn">Gravar</button>

				</div>
			</div>
			&nbsp;
			<div class="row-fluid">
				<div class="span4">
					<label class="checkbox"> <input {chk_empresaDesativada} type="checkbox" value="S">Desativado
					</label>
				</div>
			</div>
		</div>


	</form>
</div>


<?php
$this->load->view ( 'painel/templates/footer' );
?>