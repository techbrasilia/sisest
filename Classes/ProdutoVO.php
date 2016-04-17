<?php
namespace Classes;

class ProdutoVO{
	
	private $idProduto;
	private $codigoBarras;
	private $descricao;
	private $categoria;
	private $unidade;
	private $estoqueMinimo;
	private $estoqueMaximo;
	private $valorUnit;
	private $fornecedor;
	private $status;
	private $dataEntrada;
	private $usuarioCadastro;
	
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
	
	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	
	public function getCategoria(){
		return $this->categoria;
	}

	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}
	
	public function getUnidade(){
		return $this->unidade;
	}

	public function setUnidade($unidade){
		$this->unidade = $unidade;
	}
	
	public function getEstoqueMinimo(){
		return $this->estoqueMinimo;
	}

	public function setEstoqueMinimo($estoqueMinimo){
		$this->estoqueMinimo = $estoqueMinimo;
	}
	
	public function getEstoqueMaximo(){
		return $this->estoqueMaximo;
	}

	public function setEstoqueMaximo($estoqueMaximo){
		$this->estoqueMaximo = $estoqueMaximo;
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

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getUsuarioCadastro(){
		return $this->usuarioCadastro;
	}

	public function setUsuarioCadastro($usuarioCadastro){
		$this->usuarioCadastro = $usuarioCadastro;
	}

}
?>