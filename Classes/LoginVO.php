<?php
namespace Classes;

class LoginVO extends UsuarioVO{
	private $login;
	function __construct(){
		$this->login = new UsuarioVO();
	}
}
?>