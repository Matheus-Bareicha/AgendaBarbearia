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


// Recuperar os dados do formulário
$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$qtd_alerta = $_POST['qtd_alerta'];
$preco = $_POST['preco'];
$lim_venda = $_POST['lim_venda'];

// Conectar ao banco de dados

if (!$conexao) {
    $msg = "Erro ao conectar no BD.";
    header("Location: estoque.php?m=$msg");
    exit;
}


// Inserir o novo produto no banco de dados
$sql = "INSERT INTO `estoque` (Nome, Quantidade, QTD_Alerta, Preco, LIM_Venda) VALUES ('$nome', '$quantidade','$qtd_alerta','$preco','$lim_venda')";


$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    mysqli_close($conexao);
    $msg = "Registro financeiro adicionado com sucesso!";
    header("Location: estoque.php?m=$msg");
} else {
    $msg = "Erro ao adicionar o registro financeiro.";
    header("Location: estoque.php?m=$msg");
}

