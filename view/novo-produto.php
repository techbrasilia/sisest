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
		<form method="post" action="index.php?cod=novo-produto&acao=salvarProduto">
			<div>
				<div class="col-um">
					<label for="codigobarras">Cógido de Barras</label>
				</div>
				<input type="text" id="codigobarras" name="codigobarras" class="input" 
				readonly="readonly" onkeyup="buscarProduto(this.value);" />
				<!--<input type="button" value="Pesquisar" onclick="buscarProduto();" /> -->
			</div> 
			
			<div>
				<div class="col-um">
					<label for="descricaoProd">Descrição</label>
				</div>
				<input type="text" id="descricaoProd" name="descricaoProd" onkeypress="buscarProdutoDesc(this.value);" onkeyup="buscarProduto(this.value);"
					value="<?php echo (isset($produto) ? $produto->getDescricao() : '');?>" class="input"/>
			</div>
			<div>
				<input type="hidden" id="idcategoria" name="idcategoria" 
					value="<?php echo (isset($produto) ? $produto->getCategoria() : '');?>" class="input"/>
				<div class="col-um">
					<label for="categoria">Categoria</label>
				</div>
				<select id="categoria" name="categoria" class="input" > 
					<option value="">Selecione uma Categoria</option>
					<?php foreach( $this->categoria as $c):?>
						<option value="<?php echo $c['id']; ?>" <?php echo (isset($produto) && $produto->getCategoria() == $c['id'] ? 'selected' : '');?> >
							<?php echo $c['descricao_cat'] ;?>
						</option>
					<?php endforeach;?>
				</select>
			</div>
			<div>
				<div class="col-um">
					<label for="unidade">Unidade</label>
				</div>
				<select id="unidade" name="unidade" class="input" > 
					<option value="">Selecione uma Unidade</option>
					<?php foreach( $this->getUnidade() as $u):?>
						<option value="<?php echo $u['id']; ?>" <?php echo (isset($produto) && $produto->getUnidade() == $u['id'] ? 'selected' : '');?> >
							<?php echo $u['descricao'] ;?>
						</option>
					<?php endforeach;?>
				</select>
			
				<!--<label for="valorproduto">Valor Unitário</label>
				<input type="text" id="valorproduto" name="valorproduto"  
					value="<?php// echo (isset($produto) ? $produto->getValorUnit() : '');?>" class="input"/>
				-->
				<label for="estoqueMinimo">Estoque mínimo</label>
				<input type="text" id="estoqueMinimo" name="estoqueMinimo"  
					value="<?php echo (isset($produto) ? $produto->getEstoqueMinimo() : '');?>" class="input"/>
			
				<label for="estoqueMaximo">Estoque máximo</label>
				<input type="text" id="estoqueMaximo" name="estoqueMaximo"  
					value="<?php echo (isset($produto) ? $produto->getEstoqueMaximo() : '');?>" class="input"/>
			</div>
			<!--
			<div id="div_fornecedor">
				<div class="col-um">
					<label for="fornecedor">Fornecedor</label>
				</div>
				<select id="fornecedor" name="fornecedor" class="input" >
					<option value="">Selecione um Fornecedor</option>
					<?php foreach( $this->fornecedor as $f):?>
						<option value="<?php echo $f['id']; ?>"><?php echo $f['nome'] ;?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div>
				<div class="col-um">
					<label for="checkNovoFornecedor">Novo Fornecedor</label>
				</div>
				<input type="checkbox" id="checkNovoFornecedor" name="checkNovoFornecedor" value="" />
			</div>
			-->
			<div>
				<div class="col-um">
					<label for="statusProdudo">Status</label>
				</div>
				<input type="radio" id="statusProdudo" name="statusProdudo" value="A" 
				checked="<?php echo (isset($produto) && $produto->getStatus() == 'A' ? 'checked' : '');?>" />Ativo
				<input type="radio" id="statusProdudo" name="statusProdudo" value="I" 
				checked="<?php echo (isset($produto) && $produto->getStatus() == 'I' ? 'checked' : '');?>" />Inativo
			</div>
			<div>
				<input type="submit" id="salvarProduto" name="salvarProduto" value="Confirmar" class="input"/>
				<input type="reset" id="limpardados" name="limpardados" value="Limpar" class="input"/>
			</div>
		</form>
</div>

</body>
</html>