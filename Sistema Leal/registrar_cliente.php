<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Registro de Cliente</title>
</head>
<body>
    
    <form action="cregistro_cliente.php" method="POST">
    <h1 id="marca">Sistema Leal</h1>

    <h2>Registro de Cliente</h2>
    <?php
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}
	?>
    <div class= "tabela-scroll">
        <label class="titulo" for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        
        <label class="titulo" for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br>
        
        <label class="titulo" for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required><br>
        
        <label class="titulo" for="email">Email:</label>
        <input type="text" id="email" name="email" required><br>
        
        <label class="titulo" for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        
        <label class="titulo" for="confirmasenha">Confirme a Senha:</label>
        <input type="password" id="confirmasenha" name="confirmasenha" required><br>

        <label class="titulo" for="uf">UF:</label>
        <input type="text" id="uf" name="uf" required><br>
        
        <label class="titulo" for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required><br>
        </div>
        
        <input type="submit" value="Registrar">
        <a href="login_cliente.php">Voltar ao Início</a>


    </form>
</body>
</html>