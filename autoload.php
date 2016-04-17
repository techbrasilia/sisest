<?php
session_start();
if ( ! defined('WWW_ROOT')) exit; 
function __autoload($class){
	
	$class = WWW_ROOT.DS.str_replace('\\', DS, $class).'.php';
	
	if( !file_exists($class) ){
		throw new Exception("Arquivo não '{$class} existe");
	}

	//require_once (WWW_ROOT.DS.'view\header.php');
	require_once ($class);
}