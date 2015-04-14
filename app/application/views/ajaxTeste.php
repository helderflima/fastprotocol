<html>
<head>
	<title>Exemplo AJAX</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
					$("#gravar").click(function(){
						
						$.ajax({
							url: '<?php echo base_url();?>' + 'index.php/home/malotes/gravar',
							type: 'POST',
							data: $('#form').serialize(),
							success: function(msg){

									$("#mensagem").html(msg);
									
								}
						});
						return false;
					})
				});
	</script>


</head>
<body>
<form id="form">
	<table>
		<tr>
			<td>Nombre</td>
			<td><input type="text" name="name" id="name"/></td>		
		</tr>
		<tr>
			<td>Ultimo Nome</td>
			<td><input type="text" name="ultimoNome" id="ultimoNome"/></td>		
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="email" name="email" id="email"/></td>		
		</tr>
		<tr>
			<td>Descricao</td>
			<td><textarea rows="5" cols="15" type="text" name="descricao" id="descricao"></textarea></td>		
		</tr>
		<tr>
			<td>Sexo</td>
			<td>M<input type="radio" name="sexo" id="sexo" value="M"/>&nbsp&nbsp		
				F<input type="radio" name="sexo" id="sexo" value="F"/></td>		
		</tr>
		<tr>
			<td>Esporte</td>
			<td>Futebol<input type="checkbox" name="esporte[]" id="esporte[]" value="futebol"/>&nbsp&nbsp		
				Voley<input type="checkbox" name="esporte[]" id="esporte[]" value="voley"/></td>		
		</tr>
		<tr>
			<td>Color</td>
			<td>
				<select name="cor" id="cor">
					<option value="amarelo">Amarelo</option>
					<option value="vermelho">Vermelho</option>
					<option value="azul">Azul</option>
					<option value="marrom">Marrom</option>
					<option value="verde">Verde</option>
					<option value="preto">Preto</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Numero</td>
			<td>
				<select name="numero[]" id="numero[]" multiple="">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><input type="button" value="Gravar" name="gravar" id="gravar"/></td>
		</tr>
	</table>
</form>	
<div id="mensagem"></div>
</body>
</html>