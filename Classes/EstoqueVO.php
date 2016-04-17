<?php
namespace Classes;

class EstoqueVO{
	
	private $id;
	private $hotel;
	private $nome;
	private $cpf;
	private $passaporte;
	private $reserva;
	private $multiplus;
	private $observacao;
	private $datacadastro;
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}

	public function getHotel(){
		return $this->hotel;
	}
	
	public function setHotel($hotel){
		$this->hotel = $hotel;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getCpf(){
		return $this->cpf;
	}
	
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	
	public function getPassaporte(){
		return $this->passaporte;
	}
	
	public function setPassaporte($passaporte){
		$this->passaporte = $passaporte;
	}
	
	public function getReserva(){
		return $this->reserva;
	}
	
	public function setReserva($reserva){
		$this->reserva = $reserva;
	}
	
	public function getMultiplus(){
		return $this->multiplus;
	}
	
	public function setMultiplus($multiplus){
		$this->multiplus = $multiplus;
	}
	
	public function getObservacao(){
		return $this->observacao;
	}
	
	public function setObservacao($observacao){
		$this->observacao = $observacao;
	}
	
	public function getDataCadastro(){
		return $this->datacadastro;
	}
	
	public function setDataCadastro($datacadastro){
		$this->datacadastro = $datacadastro;
	}
	

}
?>