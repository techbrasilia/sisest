<?php

namespace Model;
use Classes\CategoriaVO;
use Classes\Connection;

class CategoriaDAO extends CategoriaVO{
	
	private $conexao;
	
	function __construct(){
		$this->conexao = new Connection();
	}
	
	protected $sqlInsert = "INSERT INTO categoria  
				VALUES ('%s','%s', SYSDATE())";
	protected $sqlDelete = "DELETE FROM multiplus WHERE id = %s";
	protected $sqlSelect = "SELECT * FROM categoria WHERE 1=1 %s %s %s %s ";
	protected $sqlUpdate = "UPDATE multiplus SET hotel = '%s', SET nome = '%s', SET cpf = '%s', SET passaporte = '%s', 
								SET reserva = '%s', SET multiplus = '%s', SET observacao = '%s' WHERE id = '%s' ";

	public function salvarCategoria(){
		$sql = sprintf($this->sqlInsert, '', $this->getCpf(), $this->getCnpj(), $this->getNome(), $this->getEmail());
		//echo $sql;exit();
		return $this->conexao->RunQueryLastId($sql);
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
 		//echo $sql.'';exit();
// var_dump($this->conexao);
		return $this->conexao->RunSelect(trim($sql));
	}
	
	public function load(){
		$where = '';
		$this->getIdCategoria() != null ? $where .= " AND id = ".$this->getIdCategoria() : "";
		$this->getDescricao() != null ? $where .= " AND cpf = '".$this->getDescricao()."'" : "";
		$this->getDataCadastro() != null ? $where .= "AND datacadastro = '".$this->getDataCadastro()."'" : "";
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