<?php
$this->load->view ( 'painel/templates/header' );
?>



<div class="container-fluid well">
	<legend>
			Empresas <a href="{URLFORMUSUARIO}" title="Empresas"
				class="btn pull-right btn-success"><i class="icon-plus"></i> Nova Empresa</a>
		</legend>
	<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Razão Social</th>
                  <th>CNPJ</th>
                  <th>Insc. Estadual</th>
                  <th></th>
                  
                </tr>
              </thead>
              <tbody>
              	{BLC_DADOS}
                <tr>
                  <td>{id_emp}</td>
                  <td>{nome_emp}</td>
                  <td>{cnpj_emp}</td>
                  <td>{insEst_emp}</td>
                  <td><a href="{URLEDITAR}" title="Editar"><em class="icon-pencil"></em></a>&nbsp &nbsp<a href="{URLEXCLUIR}" title="Excluir"><em class="icon-trash"></em></a> </td>
                </tr>
                {/BLC_DADOS}
                {BLC_SEMDADOS}
                <tr>
                  <td colspan="5" class="text-center">Não há dados...</td>
                </tr>
                {/BLC_SEMDADOS}
              </tbody>
            </table>
</div>

<?php
$this->load->view ( 'painel/templates/footer' );
?>