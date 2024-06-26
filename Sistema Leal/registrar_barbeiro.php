<?php
	session_start();
	if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 0 || $_SESSION['ADMIN'] != 1 ){
		$msg = "Para acessar essa página é necessário realizar o Login como admin";
		header("Location: login_funcionario.php?m=$msg");
		exit;
	}
?>
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Registro de Funcionário</title>
</head>
<body>
    
    <form action="cregistro_barbeiro.php" method="POST">
    <h1 id="marca">Sistema Leal</h1>

    <h2>Registro de Funcinário</h2>
    <?php
    require_once "config.php";
    
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}
	?>
    <div class= "tabela-scroll" style= "max-height: 500px; min-width: 700px; overflow-x: hidden;">
        <label class="titulo" for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        
        <label class="titulo" for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br>
        
        <label class="titulo" for="email">Email:</label>
        <input type="text" id="email" name="email" required><br>
        
        <label class="titulo" for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        
        <label class="titulo" for="confirmasenha">Confirme a Senha:</label>
        <input type="password" id="confirmasenha" name="confirmasenha" required><br>

        <label class="titulo" for="admin">Admin:</label>
        <input type="hidden" id="Admin" name="Admin" value="False">
        <input type="checkbox" id="Admin" name ="Admin" value = "True">

        </div>
        
        <input type="submit" value="Registrar">
        <a href="pagina_barbeiro.php">Voltar ao Início</a>


    </form>
</body>
</html>
