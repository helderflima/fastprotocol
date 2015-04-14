
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Fast Protocol</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<script src="<?php echo base_url('assets/js/jquery-1.5.2.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.maskedinput-1.3.min.js')?>"></script>

<script>
jQuery(function($){
    $("#campoData").mask("99/99/9999");
    $("#tele_usu").mask("(99)9999-9999");
    $("#campoSenha").mask("***-****");
    $("#tele_emp").mask("(99)9999-9999");
});



</script>

<!-- Le styles -->
<link href="<?php echo base_url('assets/css/bootstrap.min.css')?>"
	rel="stylesheet">
<link href="<?php echo base_url('assets/css/custom.css')?>"
	rel="stylesheet">
<style type="text/css">
body {
	padding-top: 60px;
	padding-bottom: 40px;
}

.sidebar-nav {
	padding: 9px 0;
}
</style>
<link
	href="<?php echo base_url('assets/css/bootstrap-responsive.min.css')?>"
	rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="../assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
	href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed"
	href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse"
					data-target=".nav-collapse"> <span class="icon-bar"></span> <span
					class="icon-bar"></span> <span class="icon-bar"></span>
				</a> <a class="brand" href="#">FAST PROTOCOL</a>
				<div class="nav-collapse collapse">
					<p class="navbar-text pull-right">
				<em class="icon-user"></em>{USERLOGADO} logado! | <a href="<?php echo site_url("painel/usuario/logoff"); ?>" class="navbar-link">LOGOUT</a>  
					</p>
					{MOSTRARMENUCADASTRO}
					<ul class="nav">
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown">Malotes<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo site_url("home/malotes"); ?>">Recebidos</a></li>
								<li><a href="<?php echo site_url("home/malotes/malotesEnviados"); ?>">Enviados</a></li>
							</ul>
						
						<!-- <li><a href="#contact">Relatórios</a></li> -->
						<!-- <li><a href="#contact">Suporte</a></li>  -->
						<li>
						<form class="navbar-form pull-right" method="post" action="<?php echo site_url('home/malotes/busca'); ?>">
						  	<input id="busca" name="busca" required type="text" value="{DOCBUSCAR}" class="span2" placeholder="Documento">
						  	<button type="submit" class="btn">Buscar</button>
						</form>
						
						
						</li>
					</ul>

				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
	</div>
			
	
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">