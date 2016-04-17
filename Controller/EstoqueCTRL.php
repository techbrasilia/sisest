<?php
namespace Controller;
use Model\EstoqueDAO;

class EstoqueCTRL {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $produtos = array();
		
	public function __construct($pag, $acao){
		$this->pag = $pag;
		$this->acao = $acao;
		$this->setTitulo("Controle de Estoque");
		
		
		if( $acao != null ){
			return $this->action();
			
		}else{
		
			if( isset($_REQUEST['codigo']) ){
				//$this->buscarProdutoPorCodigo();
			}

			$this->listarProdutosEstoque();

			if( isset($_REQUEST['descricaoProd']) ){
				//$this->buscarProdutoPorDesc();
				//$this->buscarProdutoPorCodigo();
			}
			
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	private function action(){
		
	}
	
	private function listarProdutosEstoque(){
	$prods = new EstoqueDAO();
	$this->setProdutos($prods->selectDadosList());
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
	
	public function getProdutos(){
		return $this->produtos;
	}
	
	public function setProdutos($produtos){
		$this->produtos = $produtos;
	}

	
}