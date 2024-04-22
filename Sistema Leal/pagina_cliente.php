<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pagina do Cliente</title>
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
		<div>
			<h2>Selecione uma opção:</h2>
			<div class="buttons-container">
				<input type="submit" formaction="agendamento.php" value="Agendar Horario">
				<input type="submit" formaction="reservar_produtos.php" value="Reservar Produtos">
			</div>
			<input type="submit" formaction="alterar_dados_cliente.php" value="Alterar dados" class="central-button">
		</div>
        <a href="clogout.php">SAIR</a>
	</form>
</body>
</html>