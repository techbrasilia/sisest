<?php

namespace Model;
use Classes\SaidaProdutoVO;
use Classes\Connection;

class SaidaProdutoDAO extends SaidaProdutoVO{
	
	private $conexao;
	
	function __construct(){
		$this->conexao = new Connection();
	}
	
	protected $sqlInsert = "INSERT INTO saida_produto VALUES ('%s', %s, '%s', '%s', '%s',SYSDATE())";
	protected $sqlDelete = "DELETE FROM saida_produto WHERE id = %s";
	protected $sqlSelect = "SELECT * FROM saida_produto WHERE 1=1 %s %s %s %s ";
	protected $sqlUpdate = "UPDATE saida_produto SET hotel = '%s', SET nome = '%s', SET cpf = '%s', SET passaporte = '%s', 
								SET reserva = '%s', SET multiplus = '%s', SET observacao = '%s' WHERE id = '%s' ";

	protected $sqlSelectPesq = "SELECT est.id, est.qtde, est.valor_unitario as valorestoque, 
				prod.codigo, prod.status, prod.descricao, prod.unidade, prod.valor,
				prod.estoque_minimo, prod.estoque_maximo,
				cat.id as idcategoria,
				cat.descricao_cat,
				forn.id as idFornecedor,
				forn.nome as Fornecedor 
				FROM estoque as est
				inner join produto as prod on ( prod.id = est.id_produto )
				inner join categoria as cat  on ( cat.id = prod.categoria )
				inner join fornecedor as forn on ( forn.id = prod.fornecedor ) 
				WHERE 1=1 %s %s %s %s ";
	
	public function salvarSaidaProduto(){

		$sql = sprintf($this->sqlInsert, '', $this->getIdProduto(), $this->getCodigoBarras(), $this->getQuantidade(),  
		str_replace(',','.',$this->getValorUnit()));
// 		echo $sql;exit();
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
 		//echo $sql;exit();
// var_dump($this->conexao);
		return $this->conexao->RunSelect(trim($sql));
	}

	public function selectDadosPesq($where=null,  $start=null, $end=null, $order=null){
		$where = $this->load();
		$start != null ? $start = 'LIMIT ' : '';
		$sql = sprintf($this->sqlSelectPesq, $where,  $start, $end, $order );
 		//echo $sql;exit();
// var_dump($this->conexao);
		return $this->conexao->RunSelect(trim($sql));
	}
	
	public function load(){
		$where = '';
		$this->getIdProduto() != null ? $where .= " AND id = '".$this->getIdProduto()."'" : "";
		$this->getCodigoBarras() != null ? $where .= " AND codigo = ".$this->getCodigoBarras() : "";
		$this->getDescricao() != null ? $where .= " AND descricao = '".$this->getDescricao()."'" : "";
		$this->getCategoria() != null ? $where .= " AND categoria = '".$this->getCategoria()."'" : "";
		$this->getUnidade() != null ? $where .= " AND unidade = '".$this->getUnidade()."'" : "";
		$this->getEstoqueMinimo() != null ? $where .= " AND estoque_minimo = ".$this->getEstoqueMinimo() : "";
		$this->getEstoqueMaximo() != null ? $where .= " AND estoque_maximo = ".$this->getEstoqueMaximo() : "";
		$this->getValorUnit() != null ? $where .= " AND valor = ".$this->getValorUnit() : "";
		$this->getFornecedor() != null ? $where .= " AND fornecedor = ".$this->getFornecedor() : "";
		$this->getDataEntrada() != null ? $where .= " AND datacadastro = '".$this->getDataEntrada()."'" : "";
		$this->getStatus() != null ? $where .= " AND status = '".$this->getStatus()."'" : "";
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
}