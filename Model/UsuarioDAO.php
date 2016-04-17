<?php

namespace Model;
use Classes\UsuarioVO;
use Classes\Connection;

class UsuarioDAO extends UsuarioVO{
	
	private $conexao;
	
	function __construct(){
		$this->conexao = new Connection();
	}
	
	protected $sqlInsert = "INSERT INTO usuarios  
				VALUES ('%s', '%s', %s, '%s', '%s', '%s', %s, SYSDATE(), %s)";
	protected $sqlDelete = "DELETE FROM multiplus WHERE id = %s";
	protected $sqlSelect = "SELECT * FROM usuarios WHERE 1=1 %s %s %s %s ";
	protected $sqlUpdate = "UPDATE multiplus SET hotel = '%s', SET nome = '%s', SET cpf = '%s', SET passaporte = '%s', 
								SET reserva = '%s', SET multiplus = '%s', SET observacao = '%s' WHERE id = '%s' ";

	public function salvarUsuario(){
		$sql = sprintf($this->sqlInsert, '', $this->getCpf(), !empty($this->getCnpj()) ? $this->getCnpj() : 'null' , $this->getNome(), $this->getEmail(), 
				MD5($this->getSenha()), $this->getPerfil(), $this->getUsuarioCadastro());
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
// 		echo $sql.'t';
// 		exit();
// var_dump($this->conexao);
		return $this->conexao->RunSelect(trim($sql));
	}
	
	public function load(){
		$where = '';
		$this->getIdUsuario() != null ? $where .= " AND id = ".$this->getIdUsuario() : "";
		$this->getCpf() != null ? $where .= " AND cpf = '".$this->getCpf()."'" : "";
		$this->getCnpj() != null ? $where .= " AND cnpj = '".$this->getCnpj()."'" : "";
		$this->getNome() != null ? $where .= " AND nome = '".$this->getNome()."'" : "";
		$this->getEmail() != null ? $where .= " AND email = '".$this->getEmail()."'" : "";
		$this->getPerfil() != null ? $where .= " AND perfil = ".$this->getPerfil() : "";
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