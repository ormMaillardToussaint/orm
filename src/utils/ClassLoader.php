<?php
class ClassLoader{
	private $prefix;

	public function __construct($prefix){
		$this->prefix = $prefix;
	}

	public function loadClass($s){
		$v = $this->prefix.DIRECTORY_SEPARATOR.str_replace("\\", DIRECTORY_SEPARATOR, $s).".php";
		require_once($v);
	}

	public function register(){
		spl_autoload_register(array($this, 'loadClass'));	
	}
}
?>