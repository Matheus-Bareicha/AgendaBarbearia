<?php
	session_start();
	if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 0){
		$msg = "Para acessar essa página é necessário realizar o Login como barbeiro";
		header("Location: login_funcionario.php?m=$msg");
		exit;
	}
?>
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Registro de Serviço</title>
</head>
<body>
    
    <form action="cregistro_servico.php" method="POST">
    <h1 id="marca">Sistema Leal</h1>

    <h2>Registro de Serviço</h2>
    <?php
    require_once "config.php";
    
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}
	?>
    <div class= "tabela-scroll" style= "max-height: 500px; min-width: 700px; overflow-x: hidden;">
        <label class="titulo" for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        
        <label class="titulo" for="valor">Valor:</label>
        <input type="text" id="valor" name="valor" required><br>
        
        <label class="titulo" for="duracao">Duração:</label>
        <input type="text" id="duracao" name="duracao" required><br>

        </div>
        
        <input type="submit" value="Registrar">
        <a href="pagina_barbeiro.php">Voltar ao Início</a>


    </form>
</body>
</html>
