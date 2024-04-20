<?php
session_start();

// Verificar se o usuário está logado
if (!$_SESSION['LOGADO']) {
    $msg = "Para acessar essa página é necessário realizar o Login";
    header("Location: login_funcionario.php?m=$msg");
    exit;
}

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
$conexao = mysqli_connect("localhost", "root", "DPDF@2000", "leal");

if (!$conexao) {
    $msg = "Erro ao conectar no BD.";
    header("Location: financeiro.php?m=$msg");
    exit;
}

// Inserir o novo registro financeiro no banco de dados
$sql = "INSERT INTO `registro financeiro` (Valor, Observacao) VALUES ('$valor', '$observacao')";

$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    mysqli_close($conexao);
    $msg = "Registro financeiro adicionado com sucesso!";
    header("Location: financeiro.php?m=$msg");
} else {
    $msg = "Erro ao adicionar o registro financeiro.";
    header("Location: financeiro.php?m=$msg");
}
?>
