<?php
    session_start();
    if(!$_SESSION['LOGADO'] || $_SESSION['TIPO'] != 0) {
        $msg = "Para acessar essa página é necessário realizar o Login como barbeiro";
        header("Location: login_funcionario.php?m=$msg");
        exit;
    }
    
    require_once "config.php"; // Conexão com o banco de dados
    
    // Consulta SQL para buscar os serviços
    $query = "SELECT * FROM servicos";
    $result = mysqli_query($conexao, $query);
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
            if(isset($_GET['m'])) {
                echo $_GET['m']; // Exibir mensagem de erro
            }
        ?>
        <div class="tabela-scroll" style="max-height: 500px; min-width: 700px; overflow-x: hidden;">
            <label class="titulo" for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>
            
            <label class="titulo" for="valor">Valor:</label>
            <input type="text" id="valor" name="valor" required><br>
            
            <label class="titulo" for="duracao">Duração:</label>
            <input type="text" id="duracao" name="duracao" required><br>
        </div>
        
        <input type="submit" value="Registrar">
        <a href="pagina_barbeiro.php">Voltar ao Início</a>

        <h2>Lista de Serviços</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Duração</th>
            <th>Ação</th>
        </tr>
        <?php
            // Loop através dos resultados da consulta
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['ID']."</td>";
                echo "<td>".$row['Nome']."</td>";
                echo "<td>".$row['Valor']."</td>";
                echo "<td>".$row['Duracao']."</td>";
                // Botão de editar
                echo "<td><a href='editar_servico.php?id=".$row['ID']."'>Editar</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    </form>

    

</body>
</html>
