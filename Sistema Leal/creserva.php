<?php


$contador = 1;
foreach ($_POST as $chave => $valor) {
    // Verifica se a chave atual é uma chave de id_produto
    if (strpos($chave, 'id_produto') !== false) {
        $id_produto = $valor;
        // Verifica se a próxima chave é uma chave de quantidadeSelecionada
        $chave_quantidade = 'quantidadeSelecionada_' . substr($chave, strlen('id_produto_'));
        if (isset($_POST[$chave_quantidade])) {
            $quantidade = $_POST[$chave_quantidade];
            // Verifica se a quantidade é diferente de zero
            if ($quantidade != 0) {
                // Aqui você pode fazer o que quiser com o par de valores
                echo "ID do Produto: $id_produto, Quantidade Selecionada: $quantidade <br>";
            }
        }
    }
    // Incrementa o contador
    $contador++;
}



?>
