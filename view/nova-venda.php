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
		<h4><a href="index.php?cod=listar-vendas"><i class="glyphicon glyphicon-list-alt"></i> Listar Vendas</a></h4>
		<h4><a href="index.php?cod=nova-venda&acao=reiniciar-venda"><i class="glyphicon glyphicon-refresh"></i> Nova Venda</a></h4>
		<form name="form_addP" >
			<div id="btn_addProduto">
				<a href="#" id="addProduto" name="addProduto" >Add Produto</a>
			</div>
		</form>
		<?php 
// 		echo '<pre>';
// 		print_r($_SESSION['lista-produtos']);
// 		echo '</pre>';
		
			if( isset($_SESSION['lista-produtos']) ):
		?>
		<form method="post" id="form_lista_venda" name="form_lista_venda" action="index.php?cod=vendas&acao=salvarVenda" class="form_lista_venda">
			<table class="table table-striped">
				<thead>
					<th>Codigo</th>
					<th>Descrição</th>
					<th>Valor</th>
					<th></th>
				</thead>
				<tbody>
		<?php 
			foreach( $_SESSION['lista-produtos'] as $key => $row  ):
// 				$this->setTotalVenda(str_replace(",", ".", $this->getTotalVenda())+ str_replace(",", ".", $row->getValorUnit()));
		?>
			<tr>
				<td><input type="text" id="codProd[]" name="codProd[]" value="<?php echo $row->getIdProduto();?>" /></td>
				<td><input type="text" id="codProd[]" name="codProd[]" value="<?php echo $row->getDescricao();?>" /></td>
				<td><input type="text" id="codProd[]" name="codProd[]" value="<?php echo $row->getValorUnit();?>" /></td>
				<td><a href="index.php?cod=vendas&acao=removerdalista&item=<?php echo $key;?>"> - </a></td>
			</tr>
		<?php 
			endforeach;
		?>
			<tr>
				<td colspan="4">
					<input type="text" id="totalVenda" name="totalVenda" value="<?php echo floatval($this->getTotalVenda());?>"/>
				</td>
			</tr>
				</tbody>
			</table>
			<input type="submit" id="salvarVenda" name="salvarVenda" value="Salvar">
		</form>
		<?php
		
			endif;
		?>
</div>
<div id="div_addProduto" style="display: none;" title="Adicionar Produto">
	<form method="post" id="form_add_produto" name="form_add_produto" action="index.php?cod=nova-venda&acao=addProduto" >
		<div>
			<div class="col-um">
				<label for="codigobarras">Cógido de Barras</label>
			</div>
			<input type="text" id="codigobarras" name="codigobarras" class="input" onkeyup="buscarProdutoVenda(this.value);" />
			<!-- <input type="button" value="Pesquisar" onclick="buscarProduto();" /> -->
		</div>
		<div>
			<input type="hidden" id="idProduto" name="idProduto" 
				value="<?php //echo (isset($produto) ? $produto->getIdProduto() : '');?>" class="input"/>
			<div class="col-um">
				<label for="descricaoProd">Descrição</label>
			</div>
			<input type="text" id="descricaoProd" name="descricaoProd" onkeyup="buscarProdutoDesc(this.value);" onkeypress="buscarProdutoVenda(this.value);"
				value="<?php //echo (isset($produto) ? $produto->getDescricao() : '');?>" class="input"/>
		</div>
		<div>
			<div class="col-um">
				<label for="categoriasel">Categoria</label>
			</div>
			<input type="text" id="categoriasel" name="categoriasel" readonly="readonly"
			value="<?php //echo (isset($produto) ? $produto->getCategoria() : '');?>" class="input" /> 
		</div>
		<div>
			<div class="col-um">
				<label for="unidade">Unidade</label>
			</div>
			<input type="text" id="unidade" name="unidade" readonly="readonly"
				value="<?php //echo (isset($produto) ? $produto->getUnidade() : '');?>" class="input"/>
		</div>
		<div>
			<label for="qtd_em_estoque">Estoque</label>
			<input type="text" id="qtd_em_estoque" name="qtd_em_estoque" class="input" style="color=red;" readonly="readonly"/>
		
			<label for="quantidade">Quantidade</label>
			<input type="text" id="quantidade" name="quantidade"  
				value="<?php //echo (isset($produto) ? $produto->getQuantidade() : '');?>" class="input"/>
				
			<label for="valorproduto">Valor Unitário</label>
			<input type="text" id="valorproduto" name="valorproduto"  
				value="<?php //echo (isset($produto) ? $produto->getValorUnit() : '');?>" class="input"/>
				
			
		</div>
		
		<div id="div_fornecedor">
			<div class="col-um">
				<label for="fornecedor">Fornecedor</label>
			</div>
			<input type="hidden" id="fornecedorId" name="fornecedorId" class="input" 
			value="<?php //echo (isset($produto) ? $produto->getFornecedor() : '');?>" />
			<input type="text" id="fornecedorDesc" name="fornecedorDesc" class="input" />
		</div>
		
		<div>
			<div class="col-um">
				<label for="statusProdudo">Status</label>
			</div>
			<input type="text" id="statusProdudo" name="statusProdudo"  readonly="readonly"
				value="<?php //echo (isset($produto) ? $produto->getStatus() : '');?>" class="input"/>
		</div>
		
		<div>
			<input type="submit" id="btnAddProduto" name="btnAddProduto" value="Adicionar" class="input"/>
			<input type="reset" id="limpardados" name="limpardados" value="Limpar" class="input"/>
		</div>
	</form>
</div>
</body>
</html>