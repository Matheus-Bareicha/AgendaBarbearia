<?php
require_once ("config.php");
  // 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
      // N/A
  
  // 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
    $Nome = $_POST['nome'];
    $Telefone = $_POST['telefone'];
    $Email = $_POST['email'];
    $Senha = $_POST['senha'];
    $ConfirmaSenha = $_POST['confirmasenha'];
    $UF = $_POST['uf'];
    $Cidade = $_POST['cidade'];
           
  // 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
      if ($Senha != $ConfirmaSenha){
        $msg = "As senha não coincidem!";
        header("Location: registrar_cliente.php?m=$msg"); // redireciona
        exit();

      }
  
      
          
  // 4. TRATAR/PREPARAR OS DADOS PARA O BD

  //5. CONECTAR NO BANCO DE DADOS
      
  
      
      if(!$conexao){
      //if($conexao == false){
          $msg = "Erro ao conectar no BD.";
          header("Location: registrar_cliente.php?m=$msg");
          exit();
      }

      $sql_verificar_email = "SELECT COUNT(*) AS total FROM cliente WHERE Email = '$Email'";
      $resultado = mysqli_query($conexao, $sql_verificar_email);
      $row = mysqli_fetch_assoc($resultado);
      if ($row['total'] > 0) {
          $msg = "E-mail já registrado!";
          header("Location: registrar_cliente.php?m=$msg"); // redireciona
          exit();
      }
      
  
  // 6. CRIAR SCRIPT SQL
      $sqlE = "INSERT INTO endereco (UF, Cidade) VALUES ('$UF', '$Cidade')";
  
  // 7. EXECUTAR SCRIPT SQL
  if (mysqli_query($conexao, $sqlE)) {
    $endereco_id = mysqli_insert_id($conexao); // Obtém o ID do endereço inserido
} else {
    $msg = "Erro ao inserir endereço: " . mysqli_error($conexao);
    header("Location: registrar_cliente.php?m=$msg"); // redireciona
    exit();
}

  $sqlC = "INSERT INTO cliente (Nome, Telefone, Email, Senha, Endereco) 
  VALUES ('$Nome', '$Telefone', '$Email', '$Senha', $endereco_id)";
  if (mysqli_query($conexao, $sqlC)) {
    $msg = "Cliente registrado com sucesso!";
} else {
    $msg = "Erro ao inserir cliente: " . mysqli_error($conexao);
    header("Location: agendamento.php?m=$msg"); // redireciona
    exit();
}

  
  
          
  // 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS
              //converter em array
  
      
  // 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
      
  
  // 10. APRESENTAR OS DADOS
      
  // 11. FECHAR CONEXÃO COM O BD
           mysqli_close ($conexao);
           header("Location: login_cliente.php?m=$msg"); // redireciona
                  exit();