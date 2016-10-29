<?php
	function __autoload($controller){
		include_once "controller/".$controller.".php";
	}
 ?>
