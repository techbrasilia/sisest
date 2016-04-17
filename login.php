<?php //require_once ('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1"/>
<title><?php echo $this->pagina->getTitulo(); ?></title>
<link href="view/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
		<div style="margin: 0 auto; width: 600px;">
			<h3><?php echo $this->pagina->getTitulo(); ?></h3>
			<form method="post" action="index.php?cod=login&acao=logar" class="form-horizontal">
			<div class="form-group">
				<label for="login" class="col-sm-2 control-label">Login</label>
				<div class="col-sm-10">
					<input type="text" id="login" name="login" required="required" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="senha" class="col-sm-2 control-label">Senha</label>
				<div class="col-sm-10">
					<input type="password" id="senha" name="senha" required="required" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" id="acessar" name="acessar" value="Entrar" class="btn btn-default"/>
				</div>
			</div>
		</form>
		</div>
	</div>
</body>
</html>