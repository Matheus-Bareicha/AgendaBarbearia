<?php
	session_start();
	if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 0){
		$msg = "Para acessar essa página é necessário realizar o Login como funcionario";
		header("Location: login_funcionario.php?m=$msg");
		exit;
	}
?>
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Encomendas</title>
</head>
<body>
    <form>
    
    <h1 id="marca">Sistema Leal</h1>

    <h2>Encomendas</h2>
    <?php
    require_once "config.php";
    
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}
	?>
    <div class= "tabela-scroll" style= "max-height: 500px; min-width: 700px; overflow-x: hidden;">
        <table border='1'>
            <tr>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Data</th>
                <th>Quantidade</th>
                <th>Estado</th>
            </tr>
            <?php
           if(isset($_GET['data']) && $_GET['data']!= '') {
            $data_selecionada = $_GET['data'];
        } else {
            $data_selecionada = date('Y-m-d');
        }
        
        $sql = "SELECT r.c_Email, c.Nome as Cliente, r.Estoque_IDProduto, r.Data, r.QTD, r.Estado, e.Nome, e.Preco
                FROM reserva r
                JOIN estoque e ON r.Estoque_IDProduto = e.IDProduto
                JOIN cliente c ON r.c_email = c.email
                WHERE DATE(r.Data) = '$data_selecionada'
                ORDER BY  r.Data, r.c_Email";

            $result = $conexao->query($sql);

            $cliente_anterior = ""; // Variável para armazenar o cliente anterior
            $data_anterior = ""; // Variável para armazenar a data anterior
            $subtotal_preco = 0; // Variável para armazenar o subtotal do preço dos registros com a data anterior

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ( abs(strtotime($row['Data']) - strtotime($data_anterior)) > 1) {

                        // Exibe uma linha de subtotal antes de cada nova data, mostrando o total do preço dos registros com a data anterior
                        if ($data_anterior != "") {
                            echo "<tr><td colspan='2'>Subtotal:</td><td>$subtotal_preco</td><td colspan='3'></td></tr>";
                        }
                        // Reinicia o subtotal do preço para a nova data
                        $subtotal_preco = 0;
                        // Exibe o cliente se for diferente do anterior
                        echo "<tr><td>" . $row['Cliente'] . "</td>"; 
                    } else {
                        // Caso contrário, apenas uma célula vazia
                        echo "<tr><td></td>"; 
                    }
                    echo "<td>" . $row['Nome'] . "</td>";
                    echo "<td>" . $row['Preco'] * $row['QTD'] . "</td>"; // Multiplica o preço pela quantidade
                    echo "<td>" . $row['Data'] . "</td>";
                    echo "<td>" . $row['QTD'] . "</td>";
                    echo "<td>" . $row['Estado'] . "</td>";
                    echo "</tr>";
                    // Adiciona o preço total da linha ao subtotal
                    $subtotal_preco += $row['Preco'] * $row['QTD'];
                    $cliente_anterior = $row['Cliente']; // Atualiza o cliente anterior
                    $data_anterior = $row['Data']; // Atualiza a data anterior
                }
                // Exibe o subtotal da última data
                echo "<tr><td colspan='2'>Subtotal:</td><td>$subtotal_preco</td><td colspan='3'></td></tr>";
            } else {
                echo "<tr><td colspan='6'>0 resultados</td></tr>";
            }
            $conexao->close();
            ?>
        </table>
    </div>
    <br/>
        <label for="data">Filtrar por data:</label>
        <input type="date" id="data" name="data">
        <input type="submit" value="Filtrar">

            <a href="pagina_barbeiro.php">Voltar</a>
    </form>
    
    
</body>
</html>
