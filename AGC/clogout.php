<?php
	session_start();
	session_destroy();
	$msg = "LogOut Bem Sucedido!";
	header("Location: login_funcionario.php?m=$msg");
?>