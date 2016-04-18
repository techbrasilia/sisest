<?php

namespace Model;
use Classes\EstoqueVO;
use Classes\Connection;

class EstoqueDAO{

	private $conexao;
	
	function __construct(){
		$this->conexao = new Connection();
	}
	
	protected $sqlInsert = "INSERT INTO multiplus  
			VALUES ('%s','%s', '%s', '%s', '%s', %s, %s, '%s', SYSDATE())";
	protected $sqlDelete = "DELETE FROM multiplus WHERE id = %s";
	protected $sqlSelect = "SELECT * FROM multiplus WHERE 1=1 %s LIMIT %s, %s %s ";
	protected $sqlUpdate = "UPDATE multiplus SET hotel = '%s', SET nome = '%s', SET cpf = '%s', SET passaporte = '%s', 
							SET reserva = '%s', SET multiplus = '%s', SET observacao = '%s' WHERE id = '%s' ";

	protected $sqlSelectList = "SELECT prod.id, prod.status, prod.descricao, un.descricao as unidade, prod.estoque_minimo, 
							prod.estoque_maximo, est.qtde as qtd_em_estoque, ent.codigo, prod.valor, 
							cat.descricao_cat as categoria 
							from entrada_produto as ent
							left join produto as prod  on ( ent.id_produto = prod.id ) 
							left join estoque as est on ( est.id_produto = prod.id ) 
							left join categoria as cat on ( cat.id = prod.categoria ) 
							left join unidade as un on ( un.id = prod.unidade ) 
							where 1=1 
							group by prod.id, ent.codigo ";
	
	protected $sqlListProdutos = "SELECT prod.id, prod.status, prod.descricao, prod.categoria, prod.unidade, prod.estoque_minimo, 
								prod.estoque_maximo, est.qtde as qtd_em_estoque, prod.valor 
								from produto as prod   
								left join estoque as est on ( est.id_produto = prod.id ) 
								where 1=1 
								group by prod.id ";
							
	public function insertDados(){
		$sql = sprintf($this->sqlInsert, '',$this->getHotel(), $this->getNome(), $this->getCpf(), $this->getPassaporte(), 
				$this->getReserva(), $this->getMultiplus(), $this->getObservacao());
// 		echo $sql;exit();
		return $this->RunQuery($sql);
	}
	
	public function updateDados(){
		$sql = sprintf($this->sqlUpdate, $this->getHotel(), $this->getNome(), $this->getCpf(), $this->getPassaporte(), 
										$this->getReserva(), $this->getMultiplus(), $this->getObservacao(), $this->getId() );
		return $this->RunQuery($sql);
	}
	
	public function deleteDados(){
		$sql = sprintf($this->sqlDelete, $this->getId());
		return $this->RunQuery($sql);
	}
	
	public function selectDados($where='',  $start='', $end='', $order=''){
		$sql = sprintf($this->sqlSelect, $where,  $start, $end, $order );
// 		echo $sql;
		return $this->RunSelect($sql);
	}
	
	public function selectDadosList($where=null,  $start=null, $end=null, $order=null){
		$start != null ? $start = 'LIMIT ' : '';
		$sql = sprintf($this->sqlListProdutos, $where,  $start, $end, $order );
		return $this->conexao->RunSelect(trim($sql));
	}
	
	public function load(){
		$rs = $this->selectDados("AND id = $this->getId()");
		$this->setHotel($rs[0]['hotel']);
		$this->setNome($rs[0]['nome']);
		$this->setCpf($rs[0]['cpf']);
		$this->setPassaporte($rs[0]['passaporte']);
		$this->setReserva($rs[0]['reserva']);
		$this->setMultiplus($rs[0]['multiplus']);
		$this->setObservacao($rs[0]['observacao']);
		$this->setDataCadastro($rs[0]['datacadastro']);
		
		return $this;
	}
	
	public function totalRegistros(){
		$sql = "SELECT * FROM multiplus WHERE 1=1";
		return $this->RunSelectCount($sql);
	}
}