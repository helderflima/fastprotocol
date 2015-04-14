<?php
$this->load->view ( 'painel/templates/header' );
?>



<div class="container-fluid well">
	<legend>
			Resultado da busca
		</legend>
		
			<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Descrição Item</th>
                  <th>Identificação Item</th>
                  <th>Malote</th>
                </tr>
              </thead>
              <tbody>
              	{BLC_DADOS}
                <tr>
                  <td>{id_seqItem}</td>
                  <td>{descricao_item}</td>
                  <td>{identificacao_item}</td>
                  <td>{id_malote}</td>
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