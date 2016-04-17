<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1"/>
<title><?php echo $this->pagina->getTitulo(); ?></title>
<link href="view/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<script src="view/bootstrap/js/jquery.js" type="text/javascript"></script>
</head>
<body>
<!-- <div class="container"> -->
<!-- 	<img alt="" src="view\image\site.jpg"> -->
<!-- </div> -->
<nav class="navbar navbar-static" style="background: #F10929;">
	<div class="container">
		<div class="nav-collapse collase">
			<ul class="nav navbar-nav">
				<li><a href="index.php" style="color: #FFFFFF; font-size: 16px;">Início</a></li>
				<li><a href="index.php?cod=usuario" style="color: #FFFFFF; font-size: 16px;">Usuário</a></li>
				<li><a href="index.php?cod=estoque" style="color: #FFFFFF; font-size: 16px;">Estoque</a></li>
				<li><a href="index.php?cod=vendas" style="color: #FFFFFF; font-size: 16px;">Vendas</a></li>
				<li><a href="index.php?cod=login&acao=sair" style="color: #FFFFFF; font-size: 16px;" >Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<?php echo isset($_SESSION['usuario-nome']) ? 'Seja bem vindo(a): '.$_SESSION['usuario-nome'] : '';?>
	<div style="margin: 0 auto; width: 600px;">
		<h1></h1>
		<h1><?php echo $this->pagina->getTitulo(); ?></h1>
		<h1><a href="index.php?cod=vender-produto.php">Vendas</a></h1>
		<h1><a href="index.php?cod=comprar-produto.php">Compras</a></h1>
	</div>
</div>
</body>
</html>