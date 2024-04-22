<!DOCTYPE html>
<html>
<head>
	<title>Sistema Leal</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<form action="" method="post">
		<h1 id="marca">Sistema Leal</h1>

		<?php
		require_once ("config.php");
			if(isset($_GET['m'])){ // Verifica se há mensagem de erro
				echo "<h2>" . $_GET['m'] . "</h2>"; // Imprime a mensagem de erro
			}
		?>
		
		<input class="cliente" type="submit" value="Cliente" formaction="login_cliente.php"
		style="height: 94px; width: 400px; font-size: 40px;">

		<input type="submit" value="Funcionário" formaction="login_funcionario.php">
		
	</form>
</body>
</html>
