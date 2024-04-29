<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Alterar Dados</title>
</head>
<body>
    
    <form action="calterar_dados_barbeiro.php" method="POST">
    <h1 id="marca">Sistema Leal</h1>

    <h2>Alterar Dados Funcionário</h2>
    <?php
    session_start();
if(!$_SESSION['LOGADO']){
    $msg = "Para acessar essa página é necessário realizar o Login";
    header("Location: login_funcionario.php?m=$msg");
    exit;
}
    require_once ("config.php");
    
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}

    $Email = $_SESSION['LOGIN'];

    if(!$conexao){
        //if($conexao == false){
            $msg = "Erro ao conectar no BD.";
            header("Location: login_funcionario.php?m=$msg");
        }
    $sql;
    // 6. CRIAR SCRIPT SQL
        $sql = "SELECT
                Email,
                Nome,
                Telefone
                FROM barbeiro
                WHERE  Email = '$Email';";

                // 7. EXECUTAR SCRIPT SQL
		    $resultado = mysqli_query($conexao, $sql);
		
            // 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS
                        //converter em array
                    $arResultado = mysqli_fetch_assoc($resultado);

                    $Nome = $arResultado['Nome'];
                    $Telefone = $arResultado['Telefone'];
                    




	?>
    <div class= "tabela-scroll" style= "max-height: 500px; min-width: 700px; overflow-x: hidden;">
        <label class="titulo" for="nome">Nome:</label>
        <input readonly  type="text" name="Nome" value="<?php echo $Nome;?>"><br/>
        
        <label class="titulo" for="telefone">Telefone:</label>
        <input type="text" name="Telefone" value="<?php echo $Telefone;?>"><br/>
        
        <label class="titulo" for="email">Email:</label>
        <input type="text" name="Email" value="<?php echo $Email;?>"><br/>
        <input type="hidden" name="EmailVelho" value="<?php echo $Email;?>"><br/>
        
        </div>
        
        <input type="submit" value="Alterar">
        <a href="pagina_barbeiro.php">Voltar ao Início</a>

    </form>
</body>
</html>