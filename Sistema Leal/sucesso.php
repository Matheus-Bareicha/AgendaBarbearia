<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sucesso</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="sucesso">
<div class="divpilar">
	<h1 id="marca">A Caverna Barbershop</h1>
	<h2><?php
	session_start();
	session_destroy();
	if(isset($_GET['m'])){
	echo $_GET['m']; 
	}
?>
	
</h2>
	
	<a href="index.php">Voltar ao Início</a>
</div>
</body>
</html>
