<?php

namespace Model;
use Classes\ProdutoVO;
use Classes\Connection;

class ProdutoDAO extends ProdutoVO{
	
	private $conexao;
	
	function __construct(){
		$this->conexao = new Connection();
	}
	
	protected $sqlInsert = "INSERT INTO produto  
				VALUES ('%s','%s', '%s', '%s', '%s', '%s', '%s', %s, %s, SYSDATE(), %s)";
	protected $sqlDelete = "DELETE FROM multiplus WHERE id = %s";
	protected $sqlSelect = "SELECT prod.id, prod.status, prod.descricao, un.descricao as unidade, prod.valor as valor_unitario,
							prod.estoque_minimo, prod.estoque_maximo, 
							cat.id as idcategoria, 
							cat.descricao_cat, 
							forn.nome, 
                            est.qtde as qtd_em_estoque 
							FROM produto as prod 
							inner join categoria as cat  on ( cat.id = prod.categoria ) 
							left join fornecedor as forn on ( forn.id = prod.fornecedor ) 
							left join unidade as un on ( un.id = prod.unidade ) 
							left join estoque as est on ( est.id_produto =  prod.id )
							WHERE 1=1 %s %s %s %s ";
							
	protected $sqlSelectEnt = "SELECT prod.id, ent.codigo, ent.perc_venda, ent.valor_venda as valor_unitario, 
							prod.status, prod.descricao, prod.unidade as id_unidade, un.descricao as unidade, 
							prod.estoque_minimo, prod.estoque_maximo, 
							cat.id as idcategoria, 
							cat.descricao_cat, 
							forn.nome, 
                            est.qtde as qtd_em_estoque  
							FROM entrada_produto ent 
                            right join produto as prod on ( ent.id_produto = prod.id ) 
							inner join categoria as cat  on ( cat.id = prod.categoria ) 
							left join fornecedor as forn on ( forn.id = ent.fornecedor ) 
							left join unidade as un on ( un.id = prod.unidade ) 
							left join estoque as est on ( est.id_produto =  ent.id_produto )
							WHERE 1=1 %s %s %s %s order by ent.id desc limit 1 ";
	protected $sqlSelectList = "SELECT prod.id, prod.status, prod.descricao, prod.categoria, prod.unidade, prod.estoque_minimo, 
								prod.estoque_maximo, est.qtde as qtd_em_estoque, ent.codigo 
								from entrada_produto as ent
								left join produto as prod  on ( ent.id_produto = prod.id ) 
								left join estoque as est on ( est.id_produto = prod.id ) where 1=1 
								group by prod.id, ent.codigo  ";

	protected $sqlListProdutos = "SELECT prod.id, prod.status, prod.descricao, prod.categoria, prod.unidade, prod.estoque_minimo, 
								prod.estoque_maximo, est.qtde as qtd_em_estoque 
								from produto as prod   
								left join estoque as est on ( est.id_produto = prod.id ) 
								where 1=1 
								group by prod.id ";
								
	protected $sqlUpdate = "UPDATE produto SET status = '%s', descricao = '%s', categoria = %s, unidade = %s, estoque_minimo = %s, 
							estoque_maximo = %s WHERE id = %s ";

	public function salvarProduto(){

		$sql = sprintf($this->sqlInsert, '', $this->getStatus(), $this->getDescricao(), $this->getCategoria(), 
		$this->getUnidade(), str_replace(',','.',$this->getValorUnit()), $this->getFornecedor(), $this->getEstoqueMinimo(), 
		$this->getEstoqueMaximo(), $this->getUsuarioCadastro());
		//echo $sql;//exit();
		return $this->conexao->RunQuery($sql);
	}
	
	public function atualizarProduto(){
		$sql = sprintf($this->sqlUpdate, $this->getStatus(), $this->getDescricao(), $this->getCategoria(), $this->getUnidade(), 
										$this->getEstoqueMinimo(), $this->getEstoqueMaximo(), $this->getIdProduto() );

		//echo $sql;exit();					
		return $this->conexao->RunQuery($sql);
	}
	
	public function deleteDados(){
		$sql = sprintf($this->sqlDelete, $this->getId());
		return $this->conexao->RunQuery($sql);
	}
	
	public function selectDados($where=null,  $start=null, $end=null, $order=null){
		$where = $this->load();
		$start != null ? $start = 'LIMIT ' : '';
		$sql = sprintf($this->sqlSelect, $where,  $start, $end, $order );
		//var_dump($sql);
 		//echo $sql;//exit();
// var_dump($this->conexao);
		return $this->conexao->RunSelect(trim($sql));
	}
	
	public function selectDadosList($where=null,  $start=null, $end=null, $order=null){
		$start != null ? $start = 'LIMIT ' : '';
		$sql = sprintf($this->sqlSelectList, $where,  $start, $end, $order );
		return $this->conexao->RunSelect(trim($sql));
	}
	
	public function selectDadosEnt($where=null,  $start=null, $end=null, $order=null){
		$where = $this->load();
		$start != null ? $start = 'LIMIT ' : '';
		$sql = sprintf($this->sqlSelectEnt, $where,  $start, $end, $order );
		//var_dump($sql);
 		//echo $sql;//exit();
// var_dump($this->conexao);
		return $this->conexao->RunSelect(trim($sql));
	}
	
	public function selectObjProd($where=null,  $start=null, $end=null, $order=null){
		$where = $this->load();
		$start != null ? $start = 'LIMIT ' : '';
		$sql = sprintf($this->sqlSelectEnt, $where,  $start, $end, $order );
		//var_dump($sql);
 		//echo $sql;//exit();
// var_dump($this->conexao);
		return $this->conexao->RunSelectObject(trim($sql));
	}
	
	public function load(){
		$where = '';
		$this->getIdProduto() != null ? $where .= " AND prod.id = '".$this->getIdProduto()."'" : "";
		$this->getCodigoBarras() != null ? $where .= " AND ent.codigo = ".$this->getCodigoBarras() : "";
		$this->getDescricao() != null ? $where .= " AND prod.descricao like '%".$this->getDescricao()."%'" : "";
		$this->getCategoria() != null ? $where .= " AND prod.categoria = '".$this->getCategoria()."'" : "";
		$this->getUnidade() != null ? $where .= " AND prod.unidade = '".$this->getUnidade()."'" : "";
		$this->getEstoqueMinimo() != null ? $where .= " AND prod.estoque_minimo = ".$this->getEstoqueMinimo() : "";
		$this->getEstoqueMaximo() != null ? $where .= " AND prod.estoque_maximo = ".$this->getEstoqueMaximo() : "";
		$this->getValorUnit() != null ? $where .= " AND prod.valor = ".$this->getValorUnit() : "";
		$this->getFornecedor() != null ? $where .= " AND prod.fornecedor = ".$this->getFornecedor() : "";
		$this->getDataEntrada() != null ? $where .= " AND prod.datacadastro = '".$this->getDataEntrada()."'" : "";
		$this->getStatus() != null ? $where .= " AND prod.status = '".$this->getStatus()."'" : "";
// 		echo var_dump($this);exit();
// 		$this->selectDados($where);
		return $where;
	}
	
	public function totalRegistros(){
		$sql = "SELECT * FROM multiplus WHERE 1=1";
		return $this->RunSelectCount($sql);
	}
	
// 	public function setConexao($conexao = new Connection()){
// 		$this->conexao = $conexao;
// 	}
	
// 	public function getConexao(){
// 		return $this->conexao;
// 	}

/*
SELECT produto.id, produto.codigo, produto.status, produto.descricao, produto.unidade, produto.valor, produto.estoque_minimo, 
produto.estoque_maximo, categoria.descricao as categoria, fornecedor.nome as fornecedor 
FROM produto 
inner join categoria on ( categoria.id = produto.categoria ) 
inner join fornecedor on ( fornecedor.id = produto.fornecedor ) WHERE 1=1 and codigo = 00001
*/
}