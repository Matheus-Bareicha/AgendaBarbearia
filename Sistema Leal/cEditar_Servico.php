<?php
session_start();
if(!$_SESSION['LOGADO'] || $_SESSION['TIPO'] != 0){
    $msg = "Para acessar essa página é necessário realizar o Login como barbeiro";
    header("Location: login_funcionario.php?m=$msg");
    exit;
}

require_once "config.php";

// Verifica se o método de requisição é POST

    // Recupera os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $duracao = $_POST['duracao'];

    // Preparar os dados para atualização no banco de dados
    // Aqui você pode adicionar sanitização ou validações, se necessário

    // Criar o script SQL para atualizar o serviço
    $sql = "UPDATE servicos
            SET Nome = '$nome',
                Valor = '$valor',
                Duracao = '$duracao'
            WHERE ID = $id";

    // Executar o script SQL
    $resultado = mysqli_query($conexao, $sql);

    if($resultado){
        // Fechar conexão com o banco de dados
        mysqli_close($conexao);

        $msg = "Serviço atualizado com sucesso!";
        header("Location: registrar_servico.php?m=$msg");
        exit;
    } else {
        echo "Erro ao atualizar serviço: " . mysqli_error($conexao);
    }


?>
