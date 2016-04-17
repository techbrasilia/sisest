<?php
namespace Controller;

use Model\FornecedorDAO;
use Classes\Funcoes;
class FornecedorCTRL {

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
		switch($this->acao){
			case $this->acao = 'salvarFornecedor':
				return $this->salvarFornecedor();
				break;
		}
	}
	
	private function salvarFornecedor(){
		if( isset($_POST['checkNovoFornecedor']) && $_POST['checkNovoFornecedor'] == 1 ) {
			$fornecedor = new FornecedorDAO();
		}
		$retorno = $fornecedor->salvarFornecedor();
		
		if( $retorno == 1 ){
			$this->setMsg("Produto cadastrado com sucesso!");
			unset($fornecedor);
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}else{
			$this->setMsg("Erro ao inserir produto!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
		
	}
	
	/*public function validaCPF2($cpf){
		
		return $this->funcao->validarCPF($cpf);
	}
	
	public function verificarDuplicidadeCPF($cpf){
		$userCPF = new UsuarioDAO();
		$userCPF->setCpf($cpf);
		return $userCPF->selectDados();
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
	
}