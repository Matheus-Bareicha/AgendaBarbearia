<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login de Cliente</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	
	<form action="clogin.php" method="post">
		<h1 id="marca">Sistema Leal</h1>
		<h2>Login de Cliente</h2>
		<?php
		require_once ("config.php");
		if(isset($_GET['m'])){//existe conteúdo na variavel
		echo $_GET['m']; //imprimindo a msg de erro
		}
		?>
		<label for="usuario" class="titulo">E-mail:</label>
		<input type="text" name="usuario" placeholder="Digite seu E-mail">
		<label for="senha" class="titulo">Senha:</label>
		<input type="password" name="senha">
		<input type="submit" value="Entrar">
        <!--<input type="submit" value="Trocar Senha" formaction = "troca_senha.php">-->
        <input type="submit" value="Registrar" formaction = "registrar_cliente.php">
		<input type="hidden" name= "tipo" value="1">

        <a href="index.php">Voltar ao Início</a>
    </form>



</body>
</html>
