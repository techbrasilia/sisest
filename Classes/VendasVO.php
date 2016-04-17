<?php
namespace Classes;

class VendasVO{
	
	private $id;	
	private $idProduto;
	private $idUsuario;
	private $idCliente;
	private $dataCadastro;
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getIdProduto(){
		return $this->idProduto;
	}
	
	public function setIdProduto($idProduto){
		$this->idProduto = $idProduto;
	}
	
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	
	public function getDataCadastro(){
		return $this->dataCadastro;
	}

	public function setDataCadastro($dataCadastro){
		$this->dataCadastro = $dataCadastro;
	}

}
?>