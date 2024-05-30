<?php
	session_start();
	if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 0){
		$msg = "Para acessar essa página é necessário realizar o Login como barbeiro";
		header("Location: login_funcionario.php?m=$msg");
		exit;
	}
?>
	<?php
require_once "config.php";


// Conectar ao banco de dados

if(!$conexao){
    $msg = "Erro ao conectar no BD.";
    header("Location: pagina_barbeiro.php?m=$msg");
    exit;
}

// Consulta SQL para buscar os registros financeiros
$sql = "SELECT * FROM registro_financeiro";
$resultado = mysqli_query($conexao, $sql);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Financeiro</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Inclua o plugin jQuery Mask Money -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script>
$(document).ready(function(){
    // Aplica a máscara de valor monetário ao campo de entrada com id 'valor'
    $('#valor').maskMoney({
        prefix: 'R$ ', // Adiciona o prefixo 'R$ ' ao valor
        allowNegative: false, // Impede valores negativos
        thousands: '', // Usa '.' como separador de milhar
        decimal: '.', // Usa ',' como separador decimal
        affixesStay: true // Mantém o prefixo ao focar no campo
    });

    // Remove caracteres não numéricos antes de enviar o formulário
    $('form').submit(function(){
        var valor = $('#valor').val().replace(/[^\d.]/g, ''); // Remove todos os caracteres não numéricos, exceto o ponto decimal
        $('#valor').val(valor); // Atualiza o valor do campo de entrada
    });
});
</script>
</head>
<body>
<form action="cfinanceiro.php" method="post">
<h1 id="marca">Sistema Leal</h1>
        <?php
            if(isset($_GET['m'])) {
                echo "<h2>" . $_GET['m'] . "</h2>"; //imprimindo a msg de erro
            }
            ?>


    <!-- Tabela para mostrar os registros financeiros -->
    
    <!-- Formulário para adicionar novo registro financeiro -->
    <h2>Novo Registro Financeiro</h2>

        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor" >
  
        <label for="observacao">Observação:</label>
        <input type="text" id="observacao" name="observacao" required>

        <label for="tipo">Tipo:</label>
        <label for="entrada">Entrada</label>
        <input type="radio" id="entrada" name="tipo" value="entrada" checked>
        <label for="saida">Saída</label>
        <input type="radio" id="saida" name="tipo" value="saida">
        <input type="submit" value="Adicionar Registro">

        <h2> Registros Financeiros</h2>
        <div id="tabela-scroll">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Valor</th>
                <th>Observação</th>
                <th>Data</th>
                <th>Editar</th>
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
                    echo "<td><a href='editar_financeiro.php?i=" .$row['ID_Registro']."'>Alterar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum registro encontrado.</td></tr>";
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
