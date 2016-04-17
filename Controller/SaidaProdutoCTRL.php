<?php
namespace Controller;

use Model\SaidaProdutoDAO;
use Classes\Funcoes;
class SaidaProdutoCTRL {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $funcao;
			
	public function __construct($pag, $acao){
		$this->pag = $pag;
		$this->acao = $acao;
		$this->funcao = new Funcoes();
		$this->setTitulo("Página de Saida de Produtos");
		
		if( $acao != null ){
			return $this->action();
		}else{
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	private function action(){
		switch($this->acao){
			case $this->acao = 'salvarSaidaProduto':
				return $this->salvarSaidaProduto();
				break;
		}
	}
	
	private function salvarSaidaProduto(){
	
		$SProduto = new SaidaProdutoDAO();
		$SProduto->setIdProduto(trim($_POST['idProduto'])); 
		$SProduto->setCodigoBarras(trim($_POST['codigobarras'])); 
		$SProduto->setQuantidade(trim($_POST['quantidade']));
		$SProduto->setValorUnit(trim($_POST['valorproduto']));
		
		$retorno = $SProduto->salvarSaidaProduto();
		
		if( $retorno == 1 ){
			$this->setMsg("Venda de produto efetuada com sucesso!");
			unset($SProduto);
			echo '<script>alert("Venda efetuada!")</script>';
			return header('Location: index.php?cod=vender-produto'); //abre comprar-produto
			exit();
			//require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');  -- usar para mostrar mensagem de sucesso
		}else{
			$this->setMsg("Erro ao vender produto!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
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
	
}