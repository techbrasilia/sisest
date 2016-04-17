<?php
namespace Classes;

class UnidadeVO{
	
	private $idUnidade;
	private $descricao;
	private $dataCadastro;
	
	public function getIdUnidade(){
		return $this->idUnidade;
	}
	
	public function setIdUnidade($idUnidade){
		$this->idUnidade = $idUnidade;
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