<?php
session_start();
if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 1){
    $msg = "Para acessar essa página é necessário realizar o Login como cliente";
    header("Location: login_cliente.php?m=$msg");
    exit;
}
?>
 <?php
require_once "config.php";


if (!$conexao) {
    $msg = "Erro ao conectar no BD.";
    header("Location: reservar_produtos.php?m=$msg");
    exit;
}

$email = $_SESSION['LOGIN'];
$msg = 'Produtos de ID :';


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
                // echo "ID do Produto: $id_produto, Quantidade Selecionada: $quantidade <br>";
                $sql = "INSERT INTO `reserva` (c_Email, Estoque_IDProduto, QTD, Estado) VALUES ('$email', '$id_produto', '$quantidade', 'P')";
              //  echo $sql;
              //  exit;


                if(mysqli_query($conexao, $sql)){
                    $msg .= "'$id_produto', ";
                }else{
                    $msg = "Erro ao inserir produtos na reserva.";
                    header("Location: reservar_produtos.php?m=$msg");
                }

            }
        }
    }
    // Incrementa o contador
    $contador++;
}
$msg .= "inseridos com sucesso.";
header("Location: reservar_produtos.php?m=$msg");



?>
