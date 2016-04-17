<?php if ( ! defined('WWW_ROOT')) exit; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1"/>
<title><?php echo $this->getTitulo(); ?></title>
<link href="view/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#checkNovoFornecedor').click(function(){
			$('#checkNovoFornecedor').val("1");
			$('#cnpjNovoFornecedor').show();
			$('#novoFornecedor').show();
			if( $('#checkNovoFornecedor').prop("checked") == false ){ 
				$('#cnpjNovoFornecedor').val(" ");
				$('#novoFornecedor').val(" ");
				$('#cnpjNovoFornecedor').hide();
				$('#novoFornecedor').hide();
			}
		});
	});
</script>
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
				<li><a href="index.php?cod=login&acao=sair" style="color: #FFFFFF; font-size: 16px;" >Logout</a></li>
				
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div style="margin: 0 auto; width: 600px;">
		<?php if( $this->getMsg() != null ): ?>
		<div class="alert alert-danger" role="alert">
			<span><?php echo $this->getMsg(); ?></span>
		</div>
		<?php endif;?>
		<h1><?php echo $this->getTitulo(); ?></h1>
		<form method="post" action="index.php?cod=novo-produto&acao=salvarProduto" class="form-horizontal">
			<div class="form-group">
				<label for="codigobarras" class="col-sm-2 control-label">Cógido de Barras</label>
				 <div class="col-sm-10">
					<input type="text" id="codigobarras" name="codigobarras" class="form-control" 
					value="<?php echo (isset($produto) ? $produto->getCodigoBarras() : '');?>" />
				</div>
			</div>
			<div class="form-group">
				<label for="descricao" class="col-sm-2 control-label">Descrição</label>
				<div class="col-sm-10">
					<input type="text" id="descricao" name="descricao" class="form-control" 
					value="<?php echo (isset($produto) ? $produto->getDescricao() : '');?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="unidade" class="col-sm-2 control-label">Unidade</label>
				<div class="col-sm-10">
					<input type="text" id="unidade" name="unidade" class="form-control" 
					value="<?php echo (isset($produto) ? $produto->getUnidade() : '');?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="qtdproduto" class="col-sm-2 control-label">Quantidade</label>
				<div class="col-sm-10">
					<input type="text" id="qtdproduto" name="qtdproduto" class="form-control" 
					value="<?php echo (isset($produto) ? $produto->getQtdProduto() : '');?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="valorproduto" class="col-sm-2 control-label">Valor Unitário</label>
				<div class="col-sm-10">
					<input type="text" id="valorproduto" name="valorproduto" class="form-control" 
					value="<?php echo (isset($produto) ? $produto->getValorUnit() : '');?>"/>
				</div>
			</div>
			
			<div class="form-group">
				<label for="fornecedor" class="col-sm-2 control-label">Fornecedor</label>
				<div class="col-sm-10">
					<input type="text" id="fornecedor" name="fornecedor" class="form-control" 
					value="<?php echo (isset($produto) ? $produto->getFornecedor() : '');?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="checkNovoFornecedor" class="col-sm-2 control-label">Novo Fornecedor</label>
				<div class="col-sm-10">
					<input type="checkbox" id="checkNovoFornecedor" name="checkNovoFornecedor"  class="form-control"
					value="" />
				</div>
			</div>
			<div class="form-group" id="cnpjNovoFornecedor" style="display: none;">
				<label for="cnpjNovoFornecedor" class="col-sm-2 control-label">CNPJ</label>
				<div class="col-sm-10">
					<input type="text" id="cnpjNovoFornecedor" name="cnpjNovoFornecedor" class="form-control" value=""/>
				</div>
			</div>
			<div class="form-group" id="novoFornecedor" style="display: none;">
				<label for="novoFornecedor" class="col-sm-2 control-label">Descrição do fornecedor</label>
				<div class="col-sm-10">
					<input type="text" id="novoFornecedor" name="novoFornecedor" class="form-control" value=""/>
				</div>
			</div>
			<div class="form-group">
				<label for="checkNovoFornecedor" class="col-sm-2 control-label">Status</label>
				<div class="col-sm-10">
					<input type="radio" id="statusProdudo" name="statusProdudo"  class="form-control"
					value="A" />Ativo
					<input type="radio" id="statusProdudo" name="statusProdudo"  class="form-control"
					value="I" />Inativo
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