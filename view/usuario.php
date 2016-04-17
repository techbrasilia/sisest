<?php if ( ! defined('WWW_ROOT')) exit; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1"/>
<title><?php echo $this->getTitulo(); ?></title>
<link href="view/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
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
				<li><a href="index.php?cod=login&acao=sair" style="color: #FFFFFF; font-size: 16px;" >Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div style="margin: 0 auto; width: 600px;">
		<h3><?php echo $this->getTitulo(); ?></h3>
		<h3><a href="index.php?cod=novo-usuario">Novo Usuario</a></h3>
		<h3><a href="index.php?cod=gerenciar-usuario">Gerenciar Usuários</a></h3>
	</div>
</div>
</body>
</html>