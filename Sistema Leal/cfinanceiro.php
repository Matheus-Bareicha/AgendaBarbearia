<?php
session_start();
if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 0){
    $msg = "Para acessar essa página é necessário realizar o Login como barbeiro";
    header("Location: login_funcionario.php?m=$msg");
    exit;
}
?>
 <?php
require_once ("config.php");


// Recuperar os dados do formulário
$valor = abs($_POST['valor']); // Garantir que o valor seja positivo
$observacao = $_POST['observacao'];

// Validar os dados enviados pelo formulário
if (empty($valor) || empty($observacao)) {
    $msg = "Por favor, preencha todos os campos.";
    header("Location: financeiro.php?m=$msg");
    exit;
}

// Determinar o tipo com base no sinal do valor
$tipo = ($_POST['tipo'] == 'entrada') ? 'entrada' : 'saida';
$valor = ($tipo == 'entrada') ? $valor : -$valor; // Tornar o valor negativo se o tipo for "saída"

// Conectar ao banco de dados

if (!$conexao) {
    $msg = "Erro ao conectar no BD.";
    header("Location: financeiro.php?m=$msg");
    exit;
}

// Formatar o valor como número decimal com ponto decimal e sem separador de milhar
$valor_formatado = number_format($valor, 2, '.', '');

// Inserir o novo registro financeiro no banco de dados
$sql = "INSERT INTO `registro_financeiro` (Valor, Observacao) VALUES ('$valor_formatado', '$observacao')";


$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    mysqli_close($conexao);
    $msg = "Registro financeiro adicionado com sucesso!";
    header("Location: financeiro.php?m=$msg");
} else {
    $msg = "Erro ao adicionar o registro financeiro.";
    header("Location: financeiro.php?m=$msg");
}

