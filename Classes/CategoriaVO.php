<?php
namespace Classes;

class CategoriaVO{
	
	private $idCategoria;
	private $descricao;
	private $dataCadastro;
	
	public function getIdCategoria(){
		return $this->idCategoria;
	}
	
	public function setIdCategoria($idCategoria){
		$this->idCategoria = $idCategoria;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	
	public function getDataCadastro(){
		return $this->dataCadastro;
	}

	public function setDataCadastro($dataCadastro){
		$this->dataCadastro = $dataCadastro;
	}

}
?>