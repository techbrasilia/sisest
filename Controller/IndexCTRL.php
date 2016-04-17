<?php
namespace Controller;

use Classes\IndexVO;


class IndexCTRL {
	private $controlador;
	private $cod;
	private $pag;
	private $acao;
	private $pagina;
	//private $msg;
	
	function __construct(){
		$this->pagina = new IndexVO();
		$this->pagina->setTitulo("Sistema de Estoque");
		
		if( isset($_REQUEST['cod']) && !isset($_GET['acao']) ){
			$this->cod =  $_REQUEST['cod'];
			if( isset($_REQUEST['codigo']) ){
				$p = new ProdutoCTRL($this->cod, $this->acao);
			}
			$this->getUrl();
			
		}else if( isset($_GET['acao']) ){
			$this->cod =  $_GET['cod'];
			$this->acao = $_GET['acao'];
			$this->actionController();
		}else{
			$this->verificarLogin();
			require_once (WWW_ROOT.DS.'view/index.php');
		}
	}
	
	function getUrl(){
		
		switch ($this->cod)
		{
			case $this->cod = 'usuario':
				return $this->controlador = new UsuarioCTRL($this->cod, $this->acao);
				break;
			
			case $this->cod = 'estoque':
			
				return $this->controlador = new EstoqueCTRL($this->cod, $this->acao);
				break;
				
			case $this->cod = 'novo-usuario':
				return $this->controlador = new UsuarioCTRL($this->cod, $this->acao);
				break;
			
			case $this->cod = 'novo-produto':
				return $this->controlador = new ProdutoCTRL($this->cod, $this->acao);
				break;
			
			case $this->cod = 'comprar-produto':
				return $this->controlador = new EntradaProdutoCTRL($this->cod, $this->acao);
				break;
			
			case $this->cod = 'vendas':
				return $this->controlador = new VendasCTRL($this->cod, $this->acao);
				break;
			
			case $this->cod = 'nova-venda':
				return $this->controlador = new VendasCTRL($this->cod, $this->acao);
				break;
			
			default:
				return header('Location: index.php');
				break;
		}
	}
	
	function actionController(){
		
		switch($this->acao){
			case $this->acao = 'salvarUsuario':
				return $this->controlador = new UsuarioCTRL($this->cod, $this->acao);
				break;
				
			case $this->acao = 'logar':
				return $this->controlador = new LoginCTRL($this->cod, $this->acao);
				break;
			
			case $this->acao = 'sair':
				return $this->controlador = new LoginCTRL($this->cod, $this->acao);
				break;

			case $this->acao = 'salvarProduto':
				return $this->controlador = new ProdutoCTRL($this->cod, $this->acao);
				break;
			
			case $this->acao = 'salvarEntradaProduto':
				return $this->controlador = new EntradaProdutoCTRL($this->cod, $this->acao);
				break;
				
			case $this->acao = 'addProduto':
				return $this->controlador = new VendasCTRL($this->cod, $this->acao);
				break;
				
			case $this->acao = 'removerdalista':
				return $this->controlador = new VendasCTRL($this->cod, $this->acao);
				break;
			
			case $this->acao = 'reiniciar-venda':
				return $this->controlador = new VendasCTRL($this->cod, $this->acao);
				break;
			
			case $this->acao = 'salvarVenda':
				return $this->controlador = new VendasCTRL($this->cod, $this->acao);
				break;
			
			case $this->acao = 'listar-vendas':
				return $this->controlador = new VendasCTRL($this->cod, $this->acao);
				break;
			
				default:
					return header('Location: ?cod=novo-usuario.php');
					break;
		}
	}
	
	private function verificarLogin(){
	
		if( !isset($_SESSION['usuario-id']) && $this->cod == null ){
			$this->pagina->setTitulo("Sistema de Estoque - Login");
			require_once (WWW_ROOT.DS.'login.php');
			exit();
		}
	}
	public function setControlador($controlador){
		$this->controlador = $controlador;
	}
	
	public function getControlador(){
		return $this->controlador;
	}
}