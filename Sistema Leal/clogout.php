<?php
	session_start();
	session_destroy();
	$msg = "LogOut Bem Sucedido!";
	header("Location: index.php?m=$msg");
?>