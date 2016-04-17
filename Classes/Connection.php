<?php
namespace Classes;

class Connection{
	private $user = "root";
	private $pass = "";
	private $host = "127.0.0.1";
	private $database = "lojaweb";
	private $conexao;
	private function Connect(){
		$this->conexao = new \PDO ( "mysql:host=$this->host; dbname=$this->database", $this->user, $this->pass );
		return $this->conexao;
// 		var_dump($conexao);
	}
	
	public function RunQuery($sql){
		$stm = $this->Connect()->prepare($sql);
		return $stm->execute();
	}
	
	public function RunSelect($sql){
		$stm = $this->Connect()->prepare($sql);
		$stm->execute();
		return $stm->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function RunSelectCount($sql){
		$stm = $this->Connect()->prepare($sql);
		$stm->execute();
		return $stm->rowCount();
	}
	
	public function RunSelectObject($sql){
		$stm = $this->Connect()->prepare($sql);
		$stm->execute();
		return $stm->fetch(\PDO::FETCH_OBJ);
	}
	
	public function RunQueryLastId($sql){
		$stm = $this->Connect()->prepare($sql);
		$res = $stm->execute();
		
		$r = $this->conexao->lastInsertId();
		return $r;
	}
	
	
}

?>