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
  // 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
      // N/A
  
  // 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
    $Nome = $_POST['nome'];
    $Valor = $_POST['valor'];
    $Duracao = $_POST['duracao'];
    
           
  // 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
  
      
          
  // 4. TRATAR/PREPARAR OS DADOS PARA O BD

  //5. CONECTAR NO BANCO DE DADOS
      
  
      
      if(!$conexao){
      //if($conexao == false){
          $msg = "Erro ao conectar no BD.";
          header("Location: registrar_cliente.php?m=$msg");
          exit();
      }
  
  // 6. CRIAR SCRIPT SQL

  $sql = "INSERT INTO servicos (Nome, Valor, Duracao)
  VALUES ('$Nome', '$Valor', '$Duracao')";

  if (mysqli_query($conexao, $sql)) {
    $msg = "Cliente registrado com sucesso!";
} else {
    $msg = "Erro ao registrar serviço: " . mysqli_error($conexao);
    header("Location: registrar_servico.php?m=$msg"); // redireciona
    exit();
}

  
  
          
  // 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS
              //converter em array
  
      
  // 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
      
  
  // 10. APRESENTAR OS DADOS
      
  // 11. FECHAR CONEXÃO COM O BD
           mysqli_close ($conexao);
           header("Location: pagina_barbeiro.php?m=$msg"); // redireciona
                  exit();