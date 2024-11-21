<?php 
	if (!isset($_SESSION)) {
		session_start();
	}

	if(!isset($_SESSION['global_token'])){
		$_SESSION['global_token'] = bin2hex(random_bytes(32));
	}

	if (!defined('BASE_PATH')) {
      define('BASE_PATH','https://unidad4examen-ec5712e91c3c.herokuapp.com/');
   	}

?>