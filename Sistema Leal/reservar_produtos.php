<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Reserva de Produto</title>
    <style>
        /* Estilos adicionais */
        .preco {
            text-align: right;
        }
        .quantidade-selector {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
        }
        .quantidade-btn {
            margin: 0 5px;
            cursor: pointer;
        }
    </style>
    <script>
        function incrementarQuantidade(element) {
            var quantidadeElement = element.previousElementSibling;
            var quantidade = parseInt(quantidadeElement.textContent);
            quantidadeElement.textContent = quantidade + 1;
            atualizarQuantidade(element);
        }

        function decrementarQuantidade(element) {
            var quantidadeElement = element.nextElementSibling;
            var quantidade = parseInt(quantidadeElement.textContent);
            if (quantidade > 0) {
                quantidadeElement.textContent = quantidade - 1;
                atualizarQuantidade(element);
            }
        }

        function atualizarQuantidade(element) {
            var quantidadeElement = element.previousElementSibling;
            var quantidade = parseInt(quantidadeElement.textContent);
            var idProduto = quantidadeElement.getAttribute('data-id-produto');
            document.getElementById('quantidadeSelecionada_' + idProduto).value = quantidade;
        }
    </script>
</head>
<body>
    
    <form action="creserva.php" method="POST">
    <h1 id="marca">Sistema Leal</h1>

    <h2>Reserva de Produto</h2>
    <?php
    require_once "config.php";
    
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}
	?>
    <div class= "tabela-scroll" style= "max-height: 500px; min-width: 700px; overflow-x: hidden;">

    <table>
    <thead>
        <tr>
            <th>ID Produto</th>
            <th>Nome</th>
            <th>Quantidade Disponível</th>
            <th>Seletor de Quantidade</th>
            <th>Preço (R$)</th>
            <th>Promoção (%)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Conectar ao banco de dados e recuperar os dados da tabela estoque
        $sql = "SELECT IDProduto, Nome, (Quantidade - LIM_Venda) AS QuantidadeDisponivel, Preco, Promocao FROM estoque WHERE (Quantidade - LIM_Venda) > 0";
        $resultado = mysqli_query($conexao, $sql);
        
        // Contar o número de linhas retornadas pela consulta
        $num_linhas = mysqli_num_rows($resultado);
        
        // Se não houver linhas, exibir mensagem adequada
        if ($num_linhas === 0) {
            echo "<tr><td colspan='6'>Nenhum produto disponível para venda no momento.</td></tr>";
        } else {
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['IDProduto'] . "</td>";
                echo "<td>" . $row['Nome'] . "</td>";
                echo "<td>" . $row['QuantidadeDisponivel'] . "</td>";
                echo "<td class='quantidade-selector'>";
                echo "<button class='quantidade-btn' type='button' onclick='decrementarQuantidade(this)'>-</button>";
                echo "<span data-id-produto='" . $row['IDProduto'] . "'>0</span>"; // Quantidade inicial é zero
                echo "<button class='quantidade-btn' type='button' onclick='incrementarQuantidade(this)'>+</button>";
                echo "</td>";
                echo "<td class='preco'>R$ " . number_format($row['Preco'], 2, ',', '.') . "</td>"; // Formatando o preço em reais
                echo "<td>" . ($row['Promocao'] ?? 0) . "%</td>"; // Se o valor de Promoção for NULL, exibe 0
                echo "</tr>";
                // Campos ocultos para armazenar o ID do produto e a quantidade selecionada de cada produto
                echo "<input type='hidden' name='id_produto_" . $row['IDProduto'] . "' value='" . $row['IDProduto'] . "'>";
                echo "<input type='hidden' name='quantidadeSelecionada_" . $row['IDProduto'] . "' id='quantidadeSelecionada_" . $row['IDProduto'] . "' value='0'>";
            }
        }
        mysqli_close($conexao);
        ?>
    </tbody>
</table>

        </div>
        
        <input type="submit" value="Registrar">
        <a href="pagina_barbeiro.php">Voltar ao Início</a>


    </form>
</body>
</html>
