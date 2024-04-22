<?php
require_once ("config.php");
session_start();

// Verificar se o usuário está logado
if(!$_SESSION['LOGADO']){
    $msg = "Para acessar essa página é necessário realizar o Login";
    header("Location: login_funcionario.php?m=$msg");
    exit;
}

// Conectar ao banco de dados

if(!$conexao){
    $msg = "Erro ao conectar no BD.";
    header("Location: login_funcionario.php?m=$msg");
    exit;
}

// Consulta SQL para buscar os registros financeiros
$sql = "SELECT * FROM `registro financeiro`";
$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Financeiro</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<form action="cfinanceiro.php" method="post">
<h1 id="marca">A Caverna Barbershop</h1>
        <?php
            if(isset($_GET['m'])) {
                echo "<h2>" . $_GET['m'] . "</h2>"; //imprimindo a msg de erro
            }
            ?>
    <h1>Registros Financeiros</h1>

    <!-- Tabela para mostrar os registros financeiros -->
    <div class="tabela-scroll">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Valor</th>
                <th>Observação</th>
                <th>Data</th>
            </tr>
            <?php
            // Loop para exibir os registros financeiros
            if(mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $row['ID_Registro'] . "</td>";
                    echo "<td>R$ " . $row['Valor'] . "</td>";
                    echo "<td>" . $row['Observacao'] . "</td>";
                    echo "<td>" . $row['Data'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum registro encontrado.</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Formulário para adicionar novo registro financeiro -->
    <h2>Novo Registro Financeiro</h2>

        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor" required>

        <label for="observacao">Observação:</label>
        <input type="text" id="observacao" name="observacao" required>

        <label for="tipo">Tipo:</label>
        <label for="entrada">Entrada</label>
        <input type="radio" id="entrada" name="tipo" value="entrada" checked>
        <label for="saida">Saída</label>
        <input type="radio" id="saida" name="tipo" value="saida">

        <input type="submit" value="Adicionar Registro">
    </form>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>
