<?php
$this->load->view ( 'painel/templates/header' );
?>



<div class="container-fluid well">
	<legend>
			Lista Usuários <a href="{URLFORMUSUARIO}" title="Usuarios"
				class="btn pull-right btn-success"><i class="icon-plus"></i> Novo Usuário</a>
		</legend>
	<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nome</th>
                  <th>Login</th>
                  <th colspan="2">Empresa</th>
                  
                </tr>
              </thead>
              <tbody>
              	{BLC_DADOS}
                <tr>
                  <td>{id_usu}</td>
                  <td>{primeiroNome_usu} {ultimoNome_usu}</td>
                  <td>{login_usu}</td>
                  <td>{nome_emp}</td> 
                  <td><a href="{URLEDITAR}" class="icon-pencil"></a>&nbsp &nbsp<a onclick=confirmarExclusao() href="{URLEXCLUIR}" title="Excluir"><em class="icon-trash"></em></a> </td>
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