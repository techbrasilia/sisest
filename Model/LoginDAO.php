<?php
namespace Model;
use Classes\LoginVO;
use Classes\Connection;

class LoginDAO extends LoginVO{

	private $conexao;
	
	function __construct(){
		$this->conexao = new Connection();
	}
	
		//protected $sqlInsert = "INSERT INTO usuarios VALUES ('%s','%s', '%s', '%s', SYSDATE())";
		protected $sqlSelect = "SELECT id, nome, email, perfil FROM usuarios WHERE 1=1 %s ";

	/*public function insertDados(){
		$sql = sprintf($this->sqlInsert, '',$this->getLogin(), $this->getSenha(), $this->getPerfil() );
		return $this->RunQuery($sql);
	}*/
	
	public function selectDados($where=null){
		$where = $this->loadLogin();
		$sql = sprintf($this->sqlSelect, $where );
		//CRIAR SESSÃO DO USUARIO
		//echo $sql;exit();
		return $this->conexao->RunSelect($sql);
	}
	
	public function selectDadosObjeto($where=null){
		$where = $this->loadLogin();
		$sql = sprintf($this->sqlSelect, $where );
		//CRIAR SESSÃO DO USUARIO
		//echo $sql;exit();
		return $this->conexao->RunSelectObject($sql);
	}
	
	public function loadLogin(){
		$where = '';
		
		$this->getCpf() != null ? $where .= " AND cpf = '".$this->getCpf()."'" : "";
		$this->getCnpj() != null ? $where .= " AND cnpj = '".$this->getCnpj()."'" : "";
		$this->getSenha() != null ? $where .= " AND senha = '".$this->getSenha()."'" : "";
		
		return $where;
	}
	
}