<?php
namespace Controller;
use Model\LoginDAO;
use Classes\Funcoes;

class LoginCTRL extends LoginDAO {

	private $titulo;
	private $pag;
	private $acao;
	private $msg;
	private $funcao;
		
	public function __construct($pag, $acao){
		$this->pag = $pag;
		$this->acao = $acao;
		
		if( $acao != null ){
			return $this->action();
			
		}else{
			require_once (WWW_ROOT.DS.$this->pag.'.php');
		}
	}
	
	private function action(){
		switch($this->acao){
			case $this->acao = 'logar':
				return $this->logar();
				break;
				
			case $this->acao = 'sair':
				return $this->logout();
				break;
		}
	}
	
	private function logout(){
		session_unset ();
		session_destroy ();
		return header('Location: index.php');
	}
	
	private function logar(){
		
		$login = new LoginDAO();
		if( isset($_POST['login']) && strlen($_POST['login']) > 11 ){
			$login->setCnpj(trim($_POST['login']));
		}else{
			$login->setCpf(trim($_POST['login']));
		}
		$login->setSenha(MD5(trim($_POST['senha'])));
		$res = $login->selectDadosObjeto();
		
		if( $res ){
			$_SESSION['usuario-id'] = $res->id;
			$_SESSION['usuario-nome'] = $res->nome;
			$_SESSION['usuario-email'] = $res->email;
			$_SESSION['usuario-perfil'] = $res->perfil;
			//echo $_SESSION['usuario-nome'];
			return header('Location: index.php');
		}else{
			
			return header('Location: index.php');
		}
		
		//echo $_SESSION['usuario-nome'];
	}
	
}