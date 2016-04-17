<?php
namespace Controller;

use Model\ProdutoDAO;
use Model\CategoriaDAO;
use Model\FornecedorDAO;
use Classes\Funcoes;
class ProdutoCTRL {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $funcao;
	private $fornecedor;
	private $categoria;
		
	public function __construct($pag, $acao){
		$this->pag = $pag;
		$this->acao = $acao;
		$this->funcao = new Funcoes();
		$this->setTitulo("P�gina de Produtos");
		
		if( isset($_REQUEST['codigo']) ){
			$this->buscarProdutoPorCodigo();
		}

		if( isset($_REQUEST['descricaoProd']) ){
			$this->buscarProdutoPorDesc();
			$this->buscarProdutoPorCodigo();
		}
		
		if( $acao != null ){
			return $this->action();
			
		}else{
			$c = new CategoriaDAO();
			$this->setCategoria($c->selectDados());
			
			$f = new FornecedorDAO();
			$this->setFornecedor($f->selectDados());
			
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	private function action(){
		switch($this->acao){
			case $this->acao = 'salvarProduto':
				return $this->salvarProduto();
				break;
		}
	}
	
	private function salvarProduto(){
	
		$produto = new ProdutoDAO();
		$produto->setCodigoBarras(trim($_POST['codigobarras'])); 
		$produto->setStatus(trim($_POST['statusProdudo'])); 
		
		if( empty($_POST['descricaoProd']) ){
			$this->setMsg("Insira uma descri��o do produto!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
			exit();
		}else{
			$produto->setDescricao(trim($_POST['descricaoProd']));
		}
		$produto->setCategoria(trim($_POST['categoria'])); 
		$produto->setUnidade(trim($_POST['unidade']));
		$produto->setValorUnit(trim($_POST['valorproduto']));
		$produto->setEstoqueMinimo(trim($_POST['estoqueMinimo']));
		$produto->setEstoqueMaximo(trim($_POST['estoqueMaximo']));
		
		if( isset($_POST['checkNovoFornecedor']) && $_POST['checkNovoFornecedor'] == 1 ) {

		$fornecedor = new FornecedorDAO();
		$fornecedor->setCpf(trim($_POST['cpfFornecedor']));
			$fornecedor->setCnpj(trim($_POST['cnpjFornecedor']));
			$fornecedor->setNome(trim($_POST['nomeFornecedor']));
			$fornecedor->setEmail(trim($_POST['emailFornecedor']));
			$forn = $fornecedor->salvarFornecedor();

			$produto->setFornecedor($forn);
		}else{
			$produto->setFornecedor(trim($_POST['fornecedor']));
		}
		$this->verificarProduto($produto);
		
		$retorno = $produto->salvarProduto();
		
		if( $retorno == 1 ){
			$this->setMsg("Produto cadastrado com sucesso!");
			unset($produto);
			unset($fornecedor);
			return header('Location: index.php?cod=novo-produto'); //abre novo-produto
			//require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');  -- usar para mostrar mensagem de sucesso
		}else{
			$this->setMsg("Erro ao inserir produto!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
		
	}
	private function caracter($string){
		$string = str_replace('�','a', $string);
		$string = str_replace('�','A', $string);
		$string = str_replace('�','a', $string);
		$string = str_replace('�','A', $string);
		$string = str_replace('�','e', $string);
		$string = str_replace('�','E', $string);
		$string = str_replace('�','e', $string);
		$string = str_replace('�','E', $string);
		$string = str_replace('�','i', $string);
		$string = str_replace('�','I', $string);
		$string = str_replace('�','o', $string);
		$string = str_replace('�','O', $string);
		$string = str_replace('�','o', $string);
		$string = str_replace('�','O', $string);
		$string = str_replace('�','u', $string);
		$string = str_replace('�','U', $string);
		$string = str_replace('�','c', $string);
		$string = str_replace('�','C', $string);
		return $string;
	}
	public function buscarProdutoPorCodigo(){
	header("Content-Type: text/html; charset=UTF-8",true);
		$dados = array();
		$produto = new ProdutoDAO();
		$produto->setCodigoBarras(isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null);
		$produto->setDescricao(isset($_REQUEST['descricaoProd']) ? $_REQUEST['descricaoProd'] : null);
		$res = $produto->selectDados();
		
		if( count($res) > 0 ){
			foreach( $res as $key => $row ) {
	
				$dados['Produto'][$key] = array_map('utf8_encode',$row);
			}
			echo json_encode($dados);
		}else{
			$dados['Produto'] = 0;
			echo json_encode($dados);
		}
		exit();
	}
	
	public function buscarProdutoPorDesc(){
	header("Content-Type: text/html; charset=UTF-8",true);
		$dados = array();
		$produto = new ProdutoDAO();
		$produto->setDescricao($_REQUEST['descricaoProd']);
		$res = $produto->selectDados();

		foreach( $res as $key => $row ) {
         $json[]=array(
                    'value'=> $row["descricao"],
                    'label'=>$row["descricao"].', Categoria: ['.utf8_encode($row["descricao_cat"]).'], Valor: R$ '.utf8_encode($row["valor"])
                        );
		}
 
		echo json_encode($json);
		exit();
	}
	
	private function verificarProduto($produto){
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
			$this->setMsg("Produto j� existente!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
			exit();
		}
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
	
}