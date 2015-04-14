<?php
$this->load->view ( 'home/templates/headerHome' );
?>



<div class="container-fluid">
	<legend>
			Malotes <a href="{URLFORMUSUARIO}" title="Empresas"
				class="btn pull-right"><i class="icon-plus"></i> Novo Malote</a>
		</legend>
	<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Código Malote</th>
                  <th>Remetente / Empresa</th>
                  <th>Data de Envio</th>
                  <th>Status</th>
                  <th></th>
                  
                </tr>
              </thead>
              <tbody>
              	{BLC_DADOS}
                <tr>
                  <td>{id_malote}</td>
                  <td>{usuarioRemetente_malote}</td>
                  <td>{dataEnvio_malote}</td>
                  <td>{statusMalote}</td>
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
$this->load->view ( 'home/templates/footerHome' );
?>