<?php
namespace Controller;

use Model\UsuarioDAO;
use Classes\Funcoes;
class UsuarioCTRL {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $funcao;
		
	public function __construct($pag, $acao){
		if ( !isset($_SESSION['usuario-id']) ) return header('Location: index.php');
		
		$this->pag = $pag;
		$this->acao = $acao;
		$this->funcao = new Funcoes();
		$this->setTitulo("P�gina de Usu�rios");
		
		if( $acao != null ){
			return $this->action();
			
		}else{
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	private function action(){
		switch($this->acao){
			case $this->acao = 'salvarUsuario':
				return $this->salvarUsuario();
				break;
		}
	}
	
	private function salvarUsuario(){
		
		$usuario = new UsuarioDAO();
		$usuario->setCnpj(trim($_POST['cnpj']));
		$usuario->setNome(trim($_POST['nome']));
		$usuario->setEmail(trim($_POST['email']));
		$usuario->setPerfil(trim($_POST['perfil']));
		$usuario->setUsuarioCadastro(trim($_SESSION['usuario-id']));
		
		if( isset($_POST['cpf'])){
		
			$res = $this->validaCPF2($_POST['cpf']);
		
			if( $res == true ){
				$usuario->setCpf($_POST['cpf']);
				if( $this->verificarDuplicidadeCPF($_POST['cpf']) ){
					$this->setMsg("CPF j� existente");
					require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
					exit();
				}
				
			}else{
				$this->setMsg("CPF inv�lido");
				require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
				exit();
			}
		}
		
		$usuario->setSenha(trim($_POST['senha']));
		$usuario->setConfirmaSenha(trim($_POST['confirmarsenha']));
		
		if( $usuario->getSenha() != $usuario->getConfirmaSenha() ){
			
			$this->setMsg("Senhas diferentes!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
			exit();
		}
		
		if( $usuario->getCpf() == null && $usuario->getCnpj() == null ){
			
			$this->setMsg("Preencha CPF ou CNPJ");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
			exit();
		}
		
		$retorno = $usuario->salvarUsuario();

		if( $retorno == 1 ){
			$this->setMsg("Usu�rio inserido com sucesso!");
			unset($usuario);
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}else{
			$this->setMsg("Erro ao inserir usu�rio!");
			require_once (WWW_ROOT.DS.'view\/'.$this->pag.'.php');
		}
	}
	
	public function validaCPF2($cpf){
		
		return $this->funcao->validarCPF($cpf);
	}
	
	public function verificarDuplicidadeCPF($cpf){
		$userCPF = new UsuarioDAO();
		$userCPF->setCpf($cpf);
		return $userCPF->selectDados();
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