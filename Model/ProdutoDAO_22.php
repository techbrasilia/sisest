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
				VALUES ('%s','%s','%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', SYSDATE())";
	protected $sqlDelete = "DELETE FROM multiplus WHERE id = %s";
	protected $sqlSelect = "SELECT prod.id, prod.codigo, prod.status, prod.descricao, prod.unidade, prod.valor,
							prod.estoque_minimo, prod.estoque_maximo, 
							cat.id as idcategoria, 
							cat.descricao_cat, 
							forn.nome 
							FROM produto as prod 
							inner join categoria as cat  on ( cat.id = prod.categoria ) 
							inner join fornecedor as forn on ( forn.id = prod.fornecedor ) 
							WHERE 1=1 %s %s %s %s ";
	protected $sqlUpdate = "UPDATE multiplus SET hotel = '%s', SET nome = '%s', SET cpf = '%s', SET passaporte = '%s', 
								SET reserva = '%s', SET multiplus = '%s', SET observacao = '%s' WHERE id = '%s' ";

	public function salvarProduto(){

		$sql = sprintf($this->sqlInsert, '', $this->getCodigoBarras(), $this->getStatus(), $this->getDescricao(), $this->getCategoria(), 
		$this->getUnidade(), str_replace(',','.',$this->getValorUnit()), $this->getFornecedor(), $this->getEstoqueMinimo(), $this->getEstoqueMaximo());
		//echo $sql;//exit();
		return $this->conexao->RunQuery($sql);
	}
	
	public function updateDados(){
		$sql = sprintf($this->sqlUpdate, $this->getHotel(), $this->getNome(), $this->getCpf(), $this->getPassaporte(), 
										$this->getReserva(), $this->getMultiplus(), $this->getObservacao(), $this->getId() );
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
 		//echo $sql;//exit();
// var_dump($this->conexao);
		return $this->conexao->RunSelect(trim($sql));
	}
	
	public function load(){
		$where = '';
		$this->getIdProduto() != null ? $where .= " AND prod.id = '".$this->getIdProduto()."'" : "";
		$this->getCodigoBarras() != null ? $where .= " AND prod.codigo = ".$this->getCodigoBarras() : "";
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