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
    header("Location: pagina_barbeiro.php?m=$msg");
    exit;
}

// Consulta SQL para buscar os registros financeiros
$sql = "SELECT * FROM estoque";
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
<form action="cproduto.php" method="post">
<h1 id="marca">Sistema Leal</h1>
        <?php
            if(isset($_GET['m'])) {
                echo "<h2>" . $_GET['m'] . "</h2>"; //imprimindo a msg de erro
            }
            ?>


    <!-- Tabela para mostrar os registros financeiros -->
    
    <!-- Formulário para adicionar novo registro financeiro -->
    <h2>Novo Produto</h2>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" >
  
        <label for="quantidade">Quantidade:</label>
        <input type="text" id="quantidade" name="quantidade" required>

        <label for="qtd_alerta">Quantidade para Alerta:</label>
        <input type="text" id="qtd_alerta" name="qtd_alerta" >

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" >

        <label for="lim_venda">Minimo para Venda:</label>
        <input type="text" id="lim_venda" name="lim_venda" >

        

        
        <input type="submit" value="Adicionar Produto">

        <h2> Registros Financeiros</h2>
        <div id="tabela-scroll">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Quantidade Alerta</th>
                <th>Preço</th>
                <th>Limite Venda</th>
                <th>Promoção</th>
                <th>Editar</th>

            </tr>
            <?php
          
            // Loop para exibir os registros financeiros
            if(mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $row['IDProduto'] . "</td>";
                    echo "<td>" . $row['Nome'] . "</td>";
                    echo "<td>" . $row['Quantidade'] . "</td>";
                    echo "<td>" . $row['QTD_Alerta'] . "</td>";
                    echo "<td>" . $row['Preco'] . "</td>";
                    echo "<td>" . $row['LIM_Venda'] . "</td>";
                    echo "<td>" . $row['Promocao'] ."%" . "</td>";
                    echo "<td><a href='editar_produto.php?i=" .$row['IDProduto']."'>Alterar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhum produto encontrado.</td></tr>";
            }
            ?>
        </table>
        </div>


        <a href="pagina_barbeiro.php">Voltar</a>
        
    </form>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>
