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
	<div style="margin: 0 auto; width: 600px;" class="form-usuario">
		<?php if( $this->getMsg() != null ): ?>
		<div class="alert alert-danger" role="alert">
			<span><?php echo $this->getMsg(); ?></span>
		</div>
		<?php endif;?>
		<h1><?php echo $this->getTitulo(); ?></h1>
		<form method="post" action="index.php?cod=novo-usuario&acao=salvarUsuario" class="form-horizontal">
			<div class="form-group">
				<label for="perfil" class="col-sm-2 control-label">Perfil</label>
				 <div class="col-sm-10">
					<select id="perfil" name="perfil" required="required" class="form-control">
						<option value="1">Admin</option>
						<option value="2" selected="selected" >Usuário</option>
						<option value="3">Suporte</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="cpf" class="col-sm-2 control-label">CPF</label>
				<div class="col-sm-10">
					<input type="text" id="cpf" name="cpf" class="form-control" 
					value="<?php echo (isset($usuario) ? $usuario->getCpf() : '');?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="cnpj" class="col-sm-2 control-label">CNPJ</label>
				<div class="col-sm-10">
					<input type="text" id="cnpj" name="cnpj" class="form-control" 
					value="<?php echo (isset($usuario) ? $usuario->getCnpj() : '');?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="nome" class="col-sm-2 control-label">Nome</label>
				<div class="col-sm-10">
					<input type="text" id="nome" name="nome" required="required" class="form-control" 
					value="<?php echo (isset($usuario) ? $usuario->getNome() : '');?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">E-mail</label>
				<div class="col-sm-10">
					<input type="text" id="email" name="email" required="required" class="form-control" 
					value="<?php echo (isset($usuario) ? $usuario->getEmail() : '');?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="senha" class="col-sm-2 control-label">Senha</label>
				<div class="col-sm-10">
					<input type="password" id="senha" name="senha" required="required" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label for="confirmarsenha" class="col-sm-2 control-label">Confirmar senha</label>
				<div class="col-sm-10">
					<input type="password" id="confirmarsenha" name="confirmarsenha" required="required" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" id="salvarusuario" name="salvarusuario" value="Confirmar" class="btn btn-default"/>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>