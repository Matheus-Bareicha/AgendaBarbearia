<?php
session_start();
if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 0){
    $msg = "Para acessar essa página é necessário realizar o Login como barbeiro";
    header("Location: login_funcionario.php?m=$msg");
    exit;
}
?>
 <?php
require_once "config.php";

	
	
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Definir Folgas</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<form action="cfolga.php" method="post">
		<h1 id="marca">A Caverna Barbershop</h1>
		<h2>Definir Folgas</h2>
			<?php
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}
	?>
		<label for="data" class="titulo">Data de Inicio:</label>
		<input type="date"  name="dinicio" required>
		<label for="horario" class="titulo">Horário de Inicio:</label>
		<select name="hinicio" required>
			<option value="">Selecione um horário</option>
			<option value="08:00">08:00</option>
			<option value="09:00">09:00</option>
			<option value="10:00">10:00</option>
			<option value="11:00">11:00</option>
			<option value="14:00">14:00</option>
			<option value="15:00">15:00</option>
			<option value="16:00">16:00</option>
			<option value="17:00">17:00</option>
			<option value="18:00">18:00</option>
			<option value="19:00">19:00</option>
			<option value="20:00">20:00</option>
		</select>

		<label for="data" class="titulo">Data de Fim:</label>
		<input type="date"  name="dfim" required>
		<label for="horario" class="titulo">Horário de Fim:</label>
		<select name="hfim" required>
			<option value="">Selecione um horário</option>
			<option value="08:00">08:00</option>
			<option value="09:00">09:00</option>
			<option value="10:00">10:00</option>
			<option value="11:00">11:00</option>
			<option value="14:00">14:00</option>
			<option value="15:00">15:00</option>
			<option value="16:00">16:00</option>
			<option value="17:00">17:00</option>
			<option value="18:00">18:00</option>
			<option value="19:00">19:00</option>
			<option value="20:00">20:00</option>
		</select>
		<input type="submit" value="Definir">
		<a href="pagina_barbeiro.php">Voltar ao Início</a>
	</form>
</body>
</html>