<?php
namespace Classes;

class SaidaProdutoVO{
	
	private $id;	
	private $idProduto;
	private $codigoBarras;
	private $quantidade;
	private $valorUnit;
	private $dataSaida;
	
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
	
	public function getCodigoBarras(){
		return $this->codigoBarras;
	}

	public function setCodigoBarras($codigoBarras){
		$this->codigoBarras = $codigoBarras;
	}
	
	public function getQuantidade(){
		return $this->quantidade;
	}

	public function setQuantidade($quantidade){
		$this->quantidade = $quantidade;
	}
	
	public function getValorUnit(){
		return $this->valorUnit;
	}

	public function setValorUnit($valorUnit){
		$this->valorUnit = $valorUnit;
	}
	
	public function getDataSaida(){
		return $this->dataSaida;
	}

	public function setDataSaida($dataSaida){
		$this->dataSaida = $dataSaida;
	}

	
}
?>