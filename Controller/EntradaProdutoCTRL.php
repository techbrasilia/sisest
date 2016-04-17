<?php
namespace Controller;

use Model\EntradaProdutoDAO;
use Model\FornecedorDAO;
use Classes\Funcoes;
class EntradaProdutoCTRL {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $funcao;
	private $fornecedor;
			
	public function __construct($pag, $acao){
		$this->pag = $pag;
		$this->acao = $acao;
		$this->funcao = new Funcoes();
		$this->setTitulo("Página de Compra de Produtos");
		
		if( $acao != null ){
			return $this->action();
			
		}else{
			$f = new FornecedorDAO();
			$this->setFornecedor($f->selectDados());
			
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	private function action(){
		switch($this->acao){
			case $this->acao = 'salvarEntradaProduto':
				return $this->salvarEntradaProduto();
				break;
		}
	}
	
	private function salvarEntradaProduto(){
	
		$EProduto = new EntradaProdutoDAO();
		$EProduto->setIdProduto(trim($_POST['idProduto'])); 
		if( trim($_POST['codigobarras']) == '' ){
			$this->setMsg("Falta o código de barras");
		}else{
			$EProduto->setCodigoBarras(trim($_POST['codigobarras'])); 
		}
		$EProduto->setValorUnit(trim($_POST['valorproduto']));
		$EProduto->setQuantidade(trim($_POST['quantidade']));
		$EProduto->setUsuarioCadastro(trim($_SESSION['usuario-id']));
		$EProduto->setPercentualVenda(trim($_POST['percVenda']));
		$EProduto->setValorVenda(trim($_POST['valorVenda']));
		
		if( isset($_POST['checkNovoFornecedor']) && $_POST['checkNovoFornecedor'] == 1 ) {
			if( (!isset($_POST['cnpjFornecedor']) || $_POST['cnpjFornecedor'] == "" ) && 
				(!isset($_POST['cpfFornecedor']) || $_POST['cpfFornecedor'] == "" ) && 
				(!isset($_POST['nomeFornecedor']) || $_POST['nomeFornecedor'] == "" ) ){
				$this->setMsg("Novo Fornecedor está imcompleto!");
				require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
				exit();
			}
			$fornecedor = new FornecedorDAO();
			$fornecedor->setCpf(trim($_POST['cpfFornecedor']));
			$fornecedor->setCnpj(trim($_POST['cnpjFornecedor']));
			$fornecedor->setNome(trim($_POST['nomeFornecedor']));
			$fornecedor->setEmail(trim($_POST['emailFornecedor']));
			$forn = $fornecedor->salvarFornecedor();

			$EProduto->setFornecedor($forn);
		}else if( $_POST['fornecedor'] == "" && ( !isset($_POST['checkNovoFornecedor']) || $_POST['checkNovoFornecedor'] == "" ) ){
			$this->setMsg("Selecione um fornecedor!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
			exit();
		}else{
			$EProduto->setFornecedor(trim($_POST['fornecedor']));
		}
		//$this->verificarProduto($EProduto);
		//var_dump($EProduto);exit();
		$retorno = $EProduto->salvarEntradaProduto();
		
		if( $retorno == 1 ){
			$this->setMsg("Compra de produto cadastrada com sucesso!");
			unset($EProduto);
			unset($fornecedor);
			echo '<script>alert("Compra cadastrada!")</script>';
			return header('Location: index.php?cod=estoque'); //abre comprar-produto
			exit();
			//require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');  -- usar para mostrar mensagem de sucesso
		}else{
			$this->setMsg("Erro ao inserir compra de produto!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
		
	}
	
	/*public function buscarProdutoPorCodigo(){
		$dados = array();
		$produto = new ProdutoDAO();
		$produto->setCodigoBarras($_REQUEST['codigo']);
		$res = $produto->selectDados();
// 		var_dump($res);exit();
		if( count($res) > 0 ){
			foreach( $res as $key => $row ) {
	
				$dados['Produto'][$key] = $row;
			}
			
			echo json_encode($dados);
		}else{
			$dados['Produto'] = 0;
			echo json_encode($dados);
		}
		exit();
	}*/
	
	/*private function verificarProduto($produto){
		$prod = $produto;
		$prod->setCodigoBarras(null);
		$prod->setUnidade(null);
		$prod->setEstoqueMinimo(null);
		$prod->setEstoqueMaximo(null);
		$prod->setValorUnit(null);
		$prod->setDataEntrada(null);
		$prod->setIdProduto(null);
		$res = $prod->selectDados();
		if( count($res) > 0 ){
			$this->setMsg("Produto já existente!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
			exit();
		}
	}*/
	
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
	
	public function getFornecedor(){
		return $this->fornecedor;
	}
	
	public function setFornecedor($fornecedor){
		$this->fornecedor = $fornecedor;
	}
	
}