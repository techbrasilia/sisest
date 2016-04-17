<?php
namespace Controller;

use Model\CategoriaDAO;
use Classes\Funcoes;
class CategoriaCTRL {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $funcao;
		
	public function __construct($pag, $acao){
		$this->pag = $pag;
		$this->acao = $acao;
		$this->funcao = new Funcoes();
		$this->setTitulo("Página de Fornecedor");
		
		if( $acao != null ){
			return $this->action();
			
		}else{
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	private function action(){
		
	}
	
	
	
	
	public function getTitulo(){
		return $this->titulo;
	}
	
	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	
	public function getMsg(){
		return $this->msg;
	}
	
	public function setMsg($msg){
		$this->msg = $msg;
	}
	
}