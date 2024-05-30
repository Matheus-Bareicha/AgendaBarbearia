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

// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
$id = $_POST['id'];
$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$qtd_alerta = $_POST['qtd_alerta'];
$preco = $_POST['preco'];
$limite_venda = $_POST['limite_venda'];
$promocao = $_POST['promocao'];

// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
// 3.1. VERIFICAR SE OS CAMPOS OBRIGATÓRIOS ESTÃO PREENCHIDOS
// NSA (Não se aplica neste caso, mas pode ser adicionado conforme necessário)

// 4. TRATAR/PREPARAR OS DADOS PARA O BD
// NSA

// 5. CONECTAR NO BANCO DE DADOS
// NSA

// 6. CRIAR SCRIPT SQL
$sql = "UPDATE estoque
        SET
            Nome = '".$nome."',
            Quantidade = ".$quantidade.",
            QTD_Alerta = ".$qtd_alerta.",
            Preco = ".$preco.",
            LIM_Venda = ".$limite_venda.",
            Promocao = ".$promocao."
        WHERE
            IDProduto = ".$id;

// 7. EXECUTAR SCRIPT SQL
$resultado = mysqli_query($conexao, $sql);

if($resultado){
    // 11. FECHAR CONEXÃO COM O BD
    mysqli_close($conexao);

    $msg = "Produto atualizado com sucesso!";
    header("Location: estoque.php?m=$msg");
} else {
    // Redirecionamento em caso de falha na atualização
    $msg = "Erro ao atualizar o produto: " . mysqli_error($conexao);
    header("Location: estoque.php?m=$msg");
    exit;
}
