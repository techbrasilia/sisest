<?php
namespace Controller;

use Model\ProdutoDAO;
use Model\CategoriaDAO;
use Model\FornecedorDAO;
use Model\UnidadeDAO;
use Classes\Funcoes;
class ProdutoCTRL {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $funcao;
	private $fornecedor;
	private $categoria;
	private $unidade;
	private $produto;
	
	public function __construct($pag, $acao){
		$this->pag = $pag;
		$this->acao = $acao;
		$this->funcao = new Funcoes();
		$this->setTitulo("Página de Cadastro de Produtos");
		$c = new CategoriaDAO();
		$this->setCategoria($c->selectDados());
		
		$f = new FornecedorDAO();
		$this->setFornecedor($f->selectDados());
		
		$u = new UnidadeDAO();
		$this->setUnidade($u->selectDados());
		
		if( $acao != null ){
			return $this->action();
		
		}else if( isset($_GET['id_produto']) ){
			$this->setTitulo("Página de Cadastro de Produtos - Alterar");
			$this->buscarProdutoPorCodigo();
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
			exit();
			
		}else{
		
			if( isset($_GET['codigo']) ){
				$this->buscarProdutoPorCodigo();
			}

			if( isset($_GET['descricaoProd']) ){
				$this->buscarProdutoPorDesc();
				//$this->buscarProdutoPorCodigo();
			}
			
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
		
		$produto->setStatus(trim($_POST['statusProdudo']));
		$produto->setUsuarioCadastro(trim($_SESSION['usuario-id']));
		
		if( empty($_POST['descricaoProd']) ){
			$this->setMsg("Insira uma descrição do produto!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
			exit();
		}else{
			$produto->setDescricao(trim($_POST['descricaoProd']));
		}
		$produto->setCategoria(trim($_POST['categoria'])); 
		$produto->setUnidade(trim($_POST['unidade']));
		$produto->setEstoqueMinimo(trim($_POST['estoqueMinimo']));
		$produto->setEstoqueMaximo(trim($_POST['estoqueMaximo']));
		
		if( isset($_POST['idProduto']) && $_POST['idProduto'] > 0 ){
			$produto->setIdProduto($_POST['idProduto']);
			$retorno = $produto->atualizarProduto();
		}else{
			$this->verificarProduto($produto);
			$retorno = $produto->salvarProduto();
		}
		
		if( $retorno == 1 ){
			$this->setMsg("Produto cadastrado com sucesso!");
			unset($produto);
			unset($fornecedor);
			echo '<script>alert("Produto cadastrado com sucesso!")</script>';
			//return header('Location: index.php?cod=novo-produto'); //abre novo-produto
			return header('Location: index.php?cod=estoque'); //abre comprar-produto
			exit();
			//require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');  -- usar para mostrar mensagem de sucesso
		}else{
			$this->setMsg("Erro ao inserir produto!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
		
	}
	private function caracter($string){
		$string = str_replace('á','a', $string);
		$string = str_replace('Á','A', $string);
		$string = str_replace('â','a', $string);
		$string = str_replace('Â','A', $string);
		$string = str_replace('é','e', $string);
		$string = str_replace('É','E', $string);
		$string = str_replace('ê','e', $string);
		$string = str_replace('Ê','E', $string);
		$string = str_replace('í','i', $string);
		$string = str_replace('Í','I', $string);
		$string = str_replace('ó','o', $string);
		$string = str_replace('Ó','O', $string);
		$string = str_replace('ô','o', $string);
		$string = str_replace('Ô','O', $string);
		$string = str_replace('ú','u', $string);
		$string = str_replace('Ú','U', $string);
		$string = str_replace('ç','c', $string);
		$string = str_replace('Ç','C', $string);
		return $string;
	}
	public function buscarProdutoPorCodigo(){
	
		$dados = array();
		$produto = new ProdutoDAO();
		$res = array();
		
		if( isset($_GET['codigo']) && trim($_GET['codigo']) != '' ){
			$produto->setCodigoBarras(trim($_GET['codigo']));
			$res = $produto->selectDadosEnt();
		}else if( isset($_GET['descricaoProd']) && trim($_GET['descricaoProd']) ){
			$produto->setDescricao(utf8_decode($_GET['descricaoProd']));
			$res = $produto->selectDados();
			
		}
		
		if( isset($_GET['id_produto']) ){
			
			$produto->setIdProduto(trim($_GET['id_produto']));
			return $this->produto = $produto->selectObjProd();
			
		}
		
		if( count($res) > 0 ){
			foreach( $res as $key => $row ) {
	
				$dados['Produto'][$key] = array_map('utf8_encode',$row);
				$dados['entrada_produto'][$key] = array_map('utf8_encode',$row);
			}
			echo json_encode($dados);
		}else{
			$dados['Produto'] = 0;
			echo json_encode($dados);
		}
		exit();
	}
	
	public function buscarProdutoPorDesc(){
	
		$json = array();
		$produto = new ProdutoDAO();
		$res = array();
		if( isset($_REQUEST['descricaoProd']) && trim($_REQUEST['descricaoProd']) != '' 
				&& (!isset($_REQUEST['codigo']) || trim($_REQUEST['codigo']) == '') ){
			$produto->setDescricao($_REQUEST['descricaoProd']);
			$res = $produto->selectDados();
		}
		
		if( count($res) > 0 ){
			foreach( $res as $key => $row ) {
			 $json[]=array(
						'value'=> utf8_encode($row["descricao"]),
						'label'=>utf8_encode($row["descricao"]).', Categoria: ['.utf8_encode($row["descricao_cat"]).'], Valor: R$ '.utf8_encode($row["valor_unitario"])
							);
			}
			echo json_encode($json);
		}else{
			$json[] = 0;
			echo json_encode($json);
		}
		
		exit();
	}
	
	private function verificarProduto($produto){
		$prod = new ProdutoDAO();
		$prod->setDescricao($produto->getDescricao());
		
		$res = $prod->selectDados();
		if( count($res) > 0 ){
			$this->setMsg("Produto já existente!");
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
	
	public function getUnidade(){
		return $this->unidade;
	}
	
	public function setUnidade($unidade){
		$this->unidade = $unidade;
	}
	
	public function getProduto(){
		return $this->produto;
	}
	
	public function setProduto($produto){
		$this->produto = $produto;
	}
	
}