<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Página do Barbeiro</title>
    <link rel="stylesheet" type="text/css" href= "styles.css">
</head>
<body>
    <form action="" method="post">
        <h1 id="marca">Sistema Leal</h1>
        <?php
        session_start();
        if(!$_SESSION['LOGADO']){
            $msg = "Para acessar essa página é necessário realizar o Login";
            header("Location: login_funcionario.php?m=$msg");
            exit;
        }
            if(isset($_GET['m'])) {
                echo "<h2>" . $_GET['m'] . "</h2>"; //imprimindo a msg de erro
            }
        ?>
        <h2>Selecione uma opção:</h2>

            <div class="coluna">
                <input type="submit" formaction="agendados.php" value="Agenda">
                <input type="submit" formaction="#" value="Estoque" disabled>
                <input type="submit" formaction="definir_horarios.php" value="Registrar Folga">
                <input type="submit" formaction="#" value="Registrar Serviço" disabled>
                <input type="submit" formaction="financeiro.php" value="Financeiro">
                <input type="submit" formaction="alterar_dados_barbeiro.php" value="Editar Dados">
                <input type="submit" formaction="#" value="Encomendas" disabled>
                <?php if($_SESSION['ADMIN']){
                    ?>
                <input type="submit" formaction="#" value="Registrar Funcionário"disabled>
                <?php
                }
                ?>
            </div>

		<a href="clogout.php">SAIR</a>
	    </form>
</body>
</html>
