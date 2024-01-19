<?php
	session_start();
	
	// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	if($_SESSION['LOGADO'] == true){
		}
	else{
		$msg = "Para acessar essa página é necessário realizar o Login";
		header("Location: login_funcionario.php?m=$msg");
		exit;
	}
	
	
	
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pagina do Barbeiro</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	
	<form action="" method="post">
		<h1 id="marca">A Caverna Barbershop</h1>
			<?php
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo "<h2>" . $_GET['m'] . "</h2>"; //imprimindo a msg de erro
	}					
	?>
		<h2>Selecione uma opção:</h2>
			<input type="submit" formaction="definir_horarios.php" value="Definir Folgas">
			<input type="submit" formaction="agendados.php" value="Agendamentos">
			<a href="clogout.php">SAIR</a>
		
	</form>
</body>
</html>