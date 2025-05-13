<?php  
	session_start();
	session_destroy();
	header('Location: ../tela-login/login.php');
?>