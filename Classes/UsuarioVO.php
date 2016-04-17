<?php
namespace Classes;

class UsuarioVO{
	
	private $idUsuario;
	private $cpf;
	private $cnpj;
	private $nome;
	private $email;
	private $senha;
	private $confirmaSenha;
	private $perfil;
	private $dataCadastro;
	private $usuarioCadastro;
	
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
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
	
	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getConfirmaSenha(){
		return $this->confirmaSenha;
	}

	public function setConfirmaSenha($confirmaSenha){
		$this->confirmaSenha = $confirmaSenha;
	}
	
	public function getPerfil(){
		return $this->perfil;
	}

	public function setPerfil($perfil){
		$this->perfil = $perfil;
	}

	public function getDataCadastro(){
		return $this->dataCadastro;
	}

	public function setDataCadastro($dataCadastro){
		$this->dataCadastro = $dataCadastro;
	}
	
	public function getUsuarioCadastro(){
		return $this->usuarioCadastro;
	}

	public function setUsuarioCadastro($usuarioCadastro){
		$this->usuarioCadastro = $usuarioCadastro;
	}
}
?>