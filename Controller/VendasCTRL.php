<?php
namespace Controller;

use Model\VendasDAO;
use Model\CategoriaDAO;
use Model\FornecedorDAO;
use Classes\Funcoes;
use Classes\ProdutoVO;
class VendasCTRL {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $funcao;
	private $fornecedor;
	private $categoria;
	private $produtos = array();
	private $totalVenda;
		
	public function __construct($pag, $acao){
		$this->pag = $pag;
		$this->acao = $acao;
		$this->funcao = new Funcoes();
		$this->setTitulo("Página de Vendas");
		$_SESSION['produtos'] = array();
		
		if( $acao != null ){
		
			return $this->action();
			
		}else{
			$this->calcularTotalVenda();
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	private function action(){
		switch($this->acao){
					
			case $this->acao = 'addProduto':
				return $this->addProduto();
				break;

			case $this->acao = 'removerdalista':
				return $this->removerProdutoLista();
				break;
			
			case $this->acao = 'reiniciar-venda':
				return $this->reiniciarVenda();
				break;
			
			case $this->acao = 'salvarVenda':
				return $this->salvarVenda();
				break;
			
			case $this->acao = 'listar-vendas':
				return $this->listarVendas();
				break;			
			
		}
	}
	
	private function addProduto(){
		$produtos = array();
 		
		//$this->produtos
		//var_dump($produtos);
		if( $_POST['idProduto'] ){
			
			
			$produto = new ProdutoVO();
			//echo 'teste prod <br>';
			$produto->setIdProduto(trim($_POST['idProduto'])); 
			$produto->setCodigoBarras(trim($_POST['codigobarras']));
			$produto->setDescricao(trim($_POST['descricaoProd']));
			$produto->setValorUnit(trim($_POST['valorproduto']));
						
			$produtos[] = $produto;
			if( !isset($_SESSION['lista-produtos']) ){
				$_SESSION['lista-produtos'] = array();
			}
			
			foreach( $produtos as $row ) {
				if( !in_array($row, $_SESSION['lista-produtos']) ){
					$_SESSION['lista-produtos'][] = $row;
// 					echo $row->getValorUnit().'<br/>';
				}
				
// 				echo $row->getValorUnit().'<br/>';
			}
			$this->calcularTotalVenda();
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}else{
			$this->setMsg("Erro ao add produto!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
		
	}
	
	private function calcularTotalVenda(){
		if( isset($_SESSION['lista-produtos']) ){
			foreach( $_SESSION['lista-produtos'] as $key => $row  ){
				$this->setTotalVenda(str_replace(",", ".", $this->getTotalVenda())+ str_replace(",", ".", $row->getValorUnit()));
			}
		}		
	}
	
	private function removerProdutoLista(){
		if( isset($_SESSION['lista-produtos']) ){
			unset($_SESSION['lista-produtos'][$_GET['item']]);
			$this->calcularTotalVenda();
			header('Location: index.php?cod=vendas');
// 			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	private function reiniciarVenda(){
		if( isset($_SESSION['lista-produtos']) ){
			unset($_SESSION['lista-produtos']);
			
// 			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
		header('Location: index.php?cod=nova-venda');
	}
	
	private function salvarVenda(){
		foreach( $_SESSION['lista-produtos'] as $row ){
				echo $row->getIdProduto();
				echo $row->getDescricao();
				echo $row->getValorUnit();
				echo '<br/>';
		}
		/*echo '<pre>';
		var_dump($_POST);
		echo '</pre>';*/
		exit();
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
	
	public function getCategoria(){
		return $this->categoria;
	}
	
	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}
	
	public function getFornecedor(){
		return $this->fornecedor;
	}
	
	public function setFornecedor($fornecedor){
		$this->fornecedor = $fornecedor;
	}
	
	public function getProdutos(){
		return $this->produtos;
	}
	
	public function setProdutos($produtos){
		$this->produtos = $produtos;
	}

	public function getTotalVenda(){
		return $this->totalVenda;
	}
	
	public function setTotalVenda($totalVenda){
		$this->totalVenda = $totalVenda;
	}
	
	
}