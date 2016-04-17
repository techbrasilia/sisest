<?php

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1"/>
<title><?php echo $this->getTitulo(); ?></title>
<link href="view/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="view/bootstrap/js/jquery.js"></script>
<link rel="stylesheet" href="view/bootstrap/js/jquery-ui/jquery-ui.css" type="text/css">
<script type="text/javascript" src="view/bootstrap/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="view/bootstrap/js/scripts.js"></script>
<style>
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
<script type="text/javascript">
	
</script>
</head>
<body>
<!-- <div class="container"> -->
<!-- 	<img alt="" src="view\image\site.jpg"> -->
<!-- </div> -->
	<div class="column2" id="menu_lateral">
  
		<ul>
			<li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
		</ul>
	   
		<ul>
			<li class="active"><a href="index.php?cod=estoque"><i class="glyphicon glyphicon-list-alt"></i> Estoque</a></li>
			<li class="active"><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Relatórios</a></li>
			<li><a href="#stories"><i class="glyphicon glyphicon-list"></i> Produtos</a></li>
			<li><a href="index.php?cod=novo-produto"><i class="glyphicon glyphicon-paperclip"></i> Novo Produto</a></li>
			<li><a href="index.php?cod=vender-produto"><i class="glyphicon glyphicon-paperclip"></i> Vender</a></li>
			<li><a href="index.php?cod=comprar-produto"><i class="glyphicon glyphicon-refresh"></i> Comprar</a></li>
		</ul>
	</div>
<div class="menu2">
	<div>
		<nav class="navbar navbar-static-top" style="background: #F10929;padding-left: 5px;">
			
				<div class="nav-collapse collase">
					<ul class="nav navbar-nav">
						<li><a href="index.php" style="color: #FFFFFF; font-size: 16px;">Início</a></li>
						<li><a href="index.php?cod=usuario" style="color: #FFFFFF; font-size: 16px;">Usuário</a></li>
						<li><a href="index.php?cod=estoque" style="color: #FFFFFF; font-size: 16px;">Estoque</a></li>
						<li><a href="index.php?cod=vendas" style="color: #FFFFFF; font-size: 16px;">Vendas</a></li>
						<li><a href="index.php?cod=login&acao=sair" style="color: #FFFFFF; font-size: 16px;" >Logout</a></li>
						
					</ul>
				</div>
			
		</nav>
	</div>
</div>	
<div class="container2">
		<?php if( $this->getMsg() != null ): ?>
		<div id="msg-alerta"class="alert alert-danger" role="alert">
			<span><?php echo $this->getMsg(); ?></span>
		</div>
		<?php endif;?>
		<h3><?php echo $this->getTitulo(); ?></h3>
		<h4><a href="index.php?cod=nova-venda">Nova Venda</a></h4>
		<h4><a href="index.php?cod=listar-vendas">Listar Vendas</a></h4>
</div>
</body>
</html>