<?php

namespace Model;
use Classes\EntradaProdutoVO;
use Classes\Connection;

class EntradaProdutoDAO extends EntradaProdutoVO{
	
	private $conexao;
	
	function __construct(){
		$this->conexao = new Connection();
	}
	
	protected $sqlInsert = " INSERT INTO entrada_produto VALUES ('%s','%s','%s', '%s', '%s', '%s', '%s', '%s', SYSDATE(), %s);";
	protected $sqlDelete = " DELETE FROM multiplus WHERE id = %s";
	protected $sqlSelect = " SELECT * FROM entrada_produto WHERE 1=1 %s %s %s %s ";
	protected $sqlUpdate = " UPDATE multiplus SET hotel = '%s', SET nome = '%s', SET cpf = '%s', SET passaporte = '%s', 
								SET reserva = '%s', SET multiplus = '%s', SET observacao = '%s' WHERE id = '%s' ";
	protected $sqlUpdateProd = " UPDATE produto SET valor = '%s' WHERE id = '%s' ;";

	protected $sqlSelectEnt = "SELECT prod.id, ent.codigo, ent.perc_venda, ent.valor_venda as valor_unitario, 
							prod.status, prod.descricao, un.descricao as unidade, 
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

	public function salvarEntradaProduto(){

		$sql = sprintf($this->sqlInsert, '', $this->getIdProduto(), $this->getCodigoBarras(), $this->getQuantidade(),  
		str_replace(',','.',$this->getValorUnit()), str_replace(',','.',$this->getPercentualVenda()), 
		str_replace(',','.',$this->getValorVenda()), $this->getFornecedor(), $this->getUsuarioCadastro());
		$sql .= sprintf( $this->sqlUpdateProd,$this->getValorVenda(),$this->getIdProduto() );
		//echo $sql;exit();
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
	
	public function selectDadosEnt($where=null,  $start=null, $end=null, $order=null){
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