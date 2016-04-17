$(document).ready(function(){
	$('input').keypress(function (e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        return (code == 13) ? false : true;
   });
	
		$("#msg-alerta").fadeOut(8000, function() {
			$( "msg-alerta" ).text( "'" + $( this ).text() + "' has faded!" );
			$( this ).remove();
		});
		$('#descricaoProd').focus();
		function cancelNovoForn() {
			$('#checkNovoFornecedor').val("0");
			$('#cnpjFornecedor').val(" ");
			$('#nomeFornecedor').val(" ");
			$('#cnpjFornecedor').hide();
			$('#nomeFornecedor').hide();
		}
		
		var dialog, form,
			cnpjFornecedor = $( "#cnpjFornecedor" ),
			nomeFornecedor = $( "#nomeFornecedor" ),
			cpfFornecedor = $( "#cpfFornecedor" ),
			emailFornecedor = $( "#emailFornecedor" ),
			tips = $( ".validateTips" );
		
		function updateTips( t ) {
		  tips
			.text( t )
			.addClass( "ui-state-highlight" );
		  setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 1500 );
		  }, 500 );
		}
	 
		function checkLength( o, n, min, max ) {
		  if ( o.val().length > max || o.val().length < min ) {
		  	o.addClass( "ui-state-error" );
			updateTips( "Length of " + n + " must be between " +
			  min + " and " + max + "." );
			  
			return false;
		  } else {
		  	return true;
		  }
		}
	 
		function checkRegexp( o, regexp, n ) {
		  if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
		  } else {
			return true;
		  }
		}
 
		function addFornecedor() {
			var valid = true;
			if( cnpjFornecedor.val().length > 0 && cpfFornecedor.val().length == 0 ){
				valid = valid && checkLength( cnpjFornecedor, "tcnpjFornecedor", 14, 18 );
			}
			if( cnpjFornecedor.val().length == 0 && cpfFornecedor.val().length > 0 ){
				valid = valid && checkLength( cpfFornecedor, "tcpfFornecedor", 11, 14 );
			}
		  	
			if ( valid ) {
				$( "#fornecedor" ).append( "<option " +
				  "value='" + cnpjFornecedor.val() + "' >" + nomeFornecedor.val() + "</option>" );
				  
				$( "#div_fornecedor" ).append( 
				"<br/><label >CNPJ</label>"+
				"<input type='text' name='"+cnpjFornecedor.attr('name')+"' value='" + cnpjFornecedor.val() + "' class='input'/>"+
				"<br/><label >CPF</label>"+
				"<input type='text' name='"+cpfFornecedor.attr('name')+"' value='" + cpfFornecedor.val() + "' class='input'/>" +
				"<br/><label >NOME</label>"+
				"<input type='text' name='"+nomeFornecedor.attr('name')+"' value='" + nomeFornecedor.val() + "' class='input'/>" +
				"<br/><label >E-MAIL</label>"+
				"<input type='text' name='"+emailFornecedor.attr('name')+"' value='" + emailFornecedor.val() + "' class='input'/>" );
				  
				dialog.dialog( "close" );
		  }
		  return valid;
		}
 
		dialog = $( "#div_novofornecedor" ).dialog({
		  autoOpen: false,
		  height: 400,
		  width: 450,
		  modal: true,
		  buttons: {
			"Salvar": addFornecedor,
			Cancel: function() {
				//cancelNovoForn();
				dialog.dialog( "close" );
			}
		  },
		  close: function() {
			form[ 0 ].reset();
		  }
		});
	 
		form = dialog.find( "#form_novo_forne" ).on( "submit", function( event ) {
		  event.preventDefault();
		  addFornecedor();
		});
	
		$( "#checkNovoFornecedor" ).click(function() {
			$( "#checkNovoFornecedor" ).val("1");
		  dialog.dialog( "open" );
		});
		
		
		//------ Abre dialog de adicionar produto em vendas -----
		
		form2 = dialog.find( "#form_add_produto" ).on( "submit", function( event ) {
			  event.preventDefault();
			});
		
		dialogAddProduto = $( "#div_addProduto" ).dialog({
		  autoOpen: false,
		  height: 600,
		  width: 700,
		  modal: true,
		  close: function() {
			form2[ 0 ].reset();
		  }
		});
		
		
	
		$( "#addProduto" ).click(function() {
		  dialogAddProduto.dialog( "open" );
		});
		
});
	
buscarProduto = function(){
		var codigo = $("#codigobarras").val(),
		codigobarras = $("#codigobarras"),
		descricaoProd = $("#descricaoProd").val(), 
		categoria = $("#categoria"), 
		unidade = $("#unidade"), 
		valorproduto = $("#valorproduto"),
		estoqueMinimo = $("#estoqueMinimo"), 
		estoqueMaximo = $("#estoqueMaximo"),
		fornecedor = $("#fornecedor")
		statusProdudo = $("#statusProdudo");
		
		if( codigobarras.val().length > 2 || descricaoProd.length > 2 ){
			$.ajax({
				url: "index.php", 
				type: "GET", 
				dataType: "json",
				data: {cod:'novo-produto', codigo:codigo, descricaoProd: descricaoProd},
				beforeSend: function (){
					/*if(descricaoProd.length > 2 ){
						$("#codigobarras").val("");
					}*/
//					alert(codigo);
					//$('#carregando').show();
				},
				success: function(data){
					if( data.Produto != 0 ){
						$.each(data.Produto, function(key, value){
							$("#idProduto").val( value.id );
							if( $("#codigobarras").val() == "" ){
								$("#bd_codigo").val(value.codigo)
							}
							$("#descricaoProd").val( value.descricao );
							$("#categoriasel").val( value.descricao_cat );
							$("#idcategoria").val( value.idcategoria );
							$( "#categoria" ).prepend( "<option " +
								"value='" + value.idcategoria + "' selected >" + value.descricao_cat + "</option>" );
							
							$("#unidade").val( value.unidade );
							$("#estoqueMinimo").val( value.estoque_minimo );
							$("#estoqueMaximo").val( value.estoque_maximo );
							$("#qtd_em_estoque").val( value.qtd_em_estoque );
							$("#valorproduto").val( value.valor_unitario );
							//$("#percVenda").val( value.perc_venda );
							//$("#valorVenda").val( value.valor_venda );
							$("#fornecedorDesc").val( value.nome );
							if( value.status == 'A'){
								$("#statusProdudo").val( "ATIVO" );
							}else{
								$("#statusProdudo").val( "INATIVO" );
							}
							
						});
						
					}
				
				    	//$('#carregando').hide();
				    },
				error: function(data){
					alert('erro ao buscar dados 1'+codigo+'DADOS :'+data.Produto);
					//$('#carregando').html(data);
				}
			});
		}		
	}

	buscarProdutoDesc = function(){
		var codigo = $("#codigobarras").val(),
		codigobarras = $("#codigobarras"),
		descricaoProd = $("#descricaoProd").val(), 
		categoria = $("#categoria"), 
		unidade = $("#unidade"), 
		valorproduto = $("#valorproduto"),
		estoqueMinimo = $("#estoqueMinimo"), 
		estoqueMaximo = $("#estoqueMaximo"),
		fornecedor = $("#fornecedor")
		statusProdudo = $("#statusProdudo");
		
			//var cpf = $("#cpfusuario").val();
			$.ajax({
				url: "index.php", 
				type: "GET", 
				dataType: "json",
				data: {cod:'novo-produto', descricaoProd:descricaoProd},
				beforeSend: function (){
					
				},
				success: function(data){
						
						$("#descricaoProd").autocomplete({
							source: data
						});

				    	//$('#carregando').hide();
				    },
				error: function(data){
					alert('erro ao buscar dados DADOS :'+data.Produto);
					//$('#carregando').html(data);
				}
			});
			
				
	}
	
buscarProdutoVenda = function(){
	var codigo = $("#codigobarras").val(),
		codigobarras = $("#codigobarras"),
		descricaoProd = $("#descricaoProd").val(), 
		categoria = $("#categoria"), 
		unidade = $("#unidade"), 
		valorproduto = $("#valorproduto"),
		estoqueMinimo = $("#estoqueMinimo"), 
		estoqueMaximo = $("#estoqueMaximo"),
		fornecedor = $("#fornecedor")
		statusProdudo = $("#statusProdudo");
		
		if( codigobarras.val().length > 2 || descricaoProd.length > 2 ){
			$.ajax({
				url: "index.php", 
				type: "GET", 
				dataType: "json",
				data: {cod:'novo-produto', codigo:codigo, descricaoProd: descricaoProd},
				beforeSend: function (){
					/*if(descricaoProd.length > 2 ){
						$("#codigobarras").val("");
					}*/
//					alert(codigo);
					//$('#carregando').show();
				},
				success: function(data){
					if( data.Produto != 0 ){
						$.each(data.Produto, function(key, value){
							$("#idProduto").val( value.id );
							if( $("#codigobarras").val() == "" ){
								$("#bd_codigo").val(value.codigo)
							}
							$("#descricaoProd").val( value.descricao );
							$("#categoriasel").val( value.descricao_cat );
							$("#idcategoria").val( value.idcategoria );
							$( "#categoria" ).prepend( "<option " +
								"value='" + value.idcategoria + "' selected >" + value.descricao_cat + "</option>" );
							
							$("#unidade").val( value.unidade );
							$("#estoqueMinimo").val( value.estoque_minimo );
							$("#estoqueMaximo").val( value.estoque_maximo );
							$("#qtd_em_estoque").val( value.qtd_em_estoque );
							$("#valorproduto").val( value.valor_unitario );
							//$("#percVenda").val( value.perc_venda );
							//$("#valorVenda").val( value.valor_venda );
							$("#fornecedorDesc").val( value.nome );
							if( value.status == 'A'){
								$("#statusProdudo").val( "ATIVO" );
							}else{
								$("#statusProdudo").val( "INATIVO" );
							}
							
						});
						
					}
				
				    	//$('#carregando').hide();
				    },
				error: function(data){
					alert('erro ao buscar dados 1'+codigo+'DADOS :'+data.Produto);
					//$('#carregando').html(data);
				}
			});
		}
}
	
calcularPerc = function(){
	var v_produto 	= parseFloat($("#valorproduto").val().replace(",",".")),
	v_perc_venda 	= parseFloat($("#percVenda").val().replace(",",".")),
	v_venda 		= parseFloat(0.00);
	$("#valorVenda").val("");
	v_venda = (v_produto+(v_perc_venda*v_produto/100));
	
	//alert(parseFloat(v_venda));
	$("#valorVenda").val(v_venda.toFixed(2));
	
}
