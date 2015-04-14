<?php
$this->load->view ( 'painel/templates/header' );
?>



<div class="container-fluid well">
	<legend>
			Malotes Enviados <a href="{URLFORMMALOTE}" title="Empresas"
				class="btn pull-right"><i class="icon-plus"></i> Novo Malote</a>
		</legend>
		
			<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Código Malote</th>
                  <th>Destinatário</th>
                  <th>Empresa</th>
                  <th>Data de Envio</th>
                  <th>Status</th>
                  <th></th>
                  
                </tr>
              </thead>
              <tbody>
              	{BLC_DADOS}
                <tr>
                  <td>{id_malote}</td>
                  <td>{usuarioDestino_malote}</td>
                  <td>{empresaUsuario_malote}</td>
                  <td>{dataEnvio_malote}</td>
                  <td>{statusMalote}</td>
                  <td>{BOTAOLISTENVIADOS}</td>
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