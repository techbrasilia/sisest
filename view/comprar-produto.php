<?php
//var_dump($this->produto);
//echo '<br>'.$this->produto->descricao;
//exit();
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
		<form method="post" action="index.php?cod=comprar-produto&acao=salvarEntradaProduto">
			<div>
				<div class="col-um">
					<label for="codigobarras">Cógido de Barras</label>
				</div>
				<input type="text" id="codigobarras" name="codigobarras" class="input" onkeyup="buscarProduto(this.value);" required="required" />
				<!-- <input type="button" value="Pesquisar" onclick="buscarProduto();" /> -->
			</div>
			<div>
				<input type="hidden" id="idProduto" name="idProduto" 
					value="<?php echo (isset($this->produto) ? $this->produto->id : '');?>" class="input"/>
				<div class="col-um">
					<label for="descricaoProd">Descrição</label>
				</div>
				<input type="text" id="descricaoProd" name="descricaoProd" onkeyup="buscarProdutoDesc(this.value);" onkeypress="buscarProduto(this.value);"
					value="<?php echo (isset($this->produto) ? $this->produto->descricao : '');?>" class="input" required="required"/>
				<input type="hidden" id="bd_codigo" name="bd_codigo">
			</div>
			<div>
				<div class="col-um">
					<label for="categoriasel">Categoria</label>
				</div>
				<input type="text" id="categoriasel" name="categoriasel" readonly="readonly"
				value="<?php echo (isset($this->produto) ? $this->produto->descricao_cat : '');?>" class="input" /> 
			
				<label for="unidade">Unidade</label>
				<input type="text" id="unidade" name="unidade" readonly="readonly"
					value="<?php echo (isset($this->produto) ? $this->produto->unidade : '');?>" class="input"/>
			
				<label for="qtd_em_estoque">Estoque</label>
				<input type="text" id="qtd_em_estoque" name="qtd_em_estoque" class="input" readonly="readonly" 
				value="<?php echo (isset($this->produto) ? $this->produto->qtd_em_estoque : '');?>" />
				Mín.<input type="text" id="estoqueMinimo" name="estoqueMinimo" class="input" readonly="readonly" 
				value="<?php echo (isset($this->produto) ? $this->produto->estoque_minimo : '');?>" />
				Máx.<input type="text" id="estoqueMaximo" name="estoqueMaximo" class="input" readonly="readonly" 
				value="<?php echo (isset($this->produto) ? $this->produto->estoque_maximo : '');?>" />
			</div>
			<div>
				<label for="quantidade">Quantidade</label>
				<input type="text" id="quantidade" name="quantidade"  
					value="" class="input"/>
			
				<label for="valorproduto">Valor Unitário</label>
				<input type="text" id="valorproduto" name="valorproduto"  
					value="<?php echo (isset($this->produto) ? $this->produto->valor_unitario : '');?>" class="input"/>
					
				<label for="percVenda">Percentual de Venda</label>
				<input type="text" id="percVenda" name="percVenda" onkeyup="calcularPerc(this.value)" 
					value="" class="input"/>
					
				<label for="valorVenda">Valor de Venda</label>
				<input type="text" id="valorVenda" name="valorVenda"  
					value="" class="input"/>
			</div>
			
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
					<input type="checkbox" id="checkNovoFornecedor" name="checkNovoFornecedor" value="" />
				</div>
			</div>
			
			<div>
				<div class="col-um">
					<label for="statusProdudo">Status</label>
				</div>
				<input type="text" id="statusProdudo" name="statusProdudo"  readonly="readonly"
					value="<?php echo (isset($this->produto) && $this->produto->status == 'A' ? 'ATIVO' : '');?>" class="input"/>
			</div>
			<div>
				<input type="submit" id="salvarEProduto" name="salvarEProduto" value="Confirmar" class="input"/>
				<input type="reset" id="limpardados" name="limpardados" value="Limpar" class="input"/>
			</div>
		</form>
</div>
<div id="div_novofornecedor" style="display: none;" title="Cadastrar Novo Fornecedor">
	<form id="form_novo_forne" >
		<div id="divcnpjFornecedor">
			<div class="col-um">
				<label for="cnpjFornecedor">CNPJ</label>
			</div>
			<input type="text" id="cnpjFornecedor" name="cnpjFornecedor" class="input"/>
		</div>
		<div id="divnovoFornecedor">
			<div class="col-um">
				<label for="cpfFornecedor">CPF</label>
			</div>
			<input type="text" id="cpfFornecedor" name="cpfFornecedor"  class="input"/>
		</div>
		<div id="divnovoFornecedor">
			<div class="col-um">
				<label for="nomeFornecedor">Nome</label>
			</div>
			<input type="text" id="nomeFornecedor" name="nomeFornecedor"  class="input"/>
		</div>
		<div id="divnovoFornecedor">
			<div class="col-um">
				<label for="emailFornecedor">E-Mail</label>
			</div>
			<input type="text" id="emailFornecedor" name="emailFornecedor"  class="input"/>
		</div>
		
		<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	</form>
</div>
</body>
</html>