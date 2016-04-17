<?php
namespace Classes;

class FornecedorVO{
	
	private $idFornecedor;
	private $cpf;
	private $cnpj;
	private $nome;
	private $email;
	private $dataCadastro;
	
	public function getIdFornecedor(){
		return $this->idFornecedor;
	}
	
	public function setIdFornecedor($idFornecedor){
		$this->idFornecedor = $idFornecedor;
	}
	
	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	
	public function getCnpj(){
		return $this->cnpj;
	}

	public function setCnpj($cnpj){
		$this->cnpj = $cnpj;
	}
	
	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getDataCadastro(){
		return $this->dataCadastro;
	}

	public function setDataCadastro($dataCadastro){
		$this->dataCadastro = $dataCadastro;
	}

}
?>