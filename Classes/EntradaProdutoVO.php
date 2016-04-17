<?php
namespace Classes;

class EntradaProdutoVO{
	
	private $id;	
	private $idProduto;
	private $codigoBarras;
	private $quantidade;
	private $valorUnit;
	private $fornecedor;
	private $dataEntrada;
	private $usuarioCadastro;
	private $percentualVenda;
	private $valorVenda;
	
	
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
	
	public function getFornecedor(){
		return $this->fornecedor;
	}

	public function setFornecedor($fornecedor){
		$this->fornecedor = $fornecedor;
	}
	
	public function getDataEntrada(){
		return $this->dataEntrada;
	}

	public function setDataEntrada($dataEntrada){
		$this->dataEntrada = $dataEntrada;
	}

	public function getUsuarioCadastro(){
		return $this->usuarioCadastro;
	}

	public function setUsuarioCadastro($usuarioCadastro){
		$this->usuarioCadastro = $usuarioCadastro;
	}

	public function getPercentualVenda(){
		return $this->percentualVenda;
	}

	public function setPercentualVenda($percentualVenda){
		$this->percentualVenda = $percentualVenda;
	}

	public function getValorVenda(){
		return $this->valorVenda;
	}

	public function setValorVenda($valorVenda){
		$this->valorVenda = $valorVenda;
	}

	
}
?>