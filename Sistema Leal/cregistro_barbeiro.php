<?php
session_start();
if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 0 || $_SESSION['ADMIN']!= 1){
    $msg = "Para acessar essa página é necessário realizar o Login como admin";
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
    $Telefone = $_POST['telefone'];
    $Email = $_POST['email'];
    $Senha = $_POST['senha'];
    $ConfirmaSenha = $_POST['confirmasenha'];
    $Admin = "false";
    if ($_POST['Admin'] == "on"){
    $Admin = "true";
    }
    
           
  // 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
      if ($Senha != $ConfirmaSenha){
        $msg = "As senha não coincidem!";
        header("Location: registrar_barbeiro.php?m=$msg"); // redireciona
        exit();
      }
  
      
          
  // 4. TRATAR/PREPARAR OS DADOS PARA O BD

  //5. CONECTAR NO BANCO DE DADOS
      
  
      
      if(!$conexao){
      //if($conexao == false){
          $msg = "Erro ao conectar no BD.";
          header("Location: registrar_barbeiro.php?m=$msg");
          exit();
      }

      $sql_verificar_email = "SELECT COUNT(*) AS total FROM barbeiro WHERE Email = '$Email'";
      $resultado = mysqli_query($conexao, $sql_verificar_email);
      $row = mysqli_fetch_assoc($resultado);
      if ($row['total'] > 0) {
          $msg = "E-mail já registrado!";
          header("Location: registrar_barbeiro.php?m=$msg"); // redireciona
          exit();
      }
      
  
  // 6. CRIAR SCRIPT SQL

  $sqlB = "INSERT INTO barbeiro (Nome, Telefone, Email, Senha, Admin)
  VALUES ('$Nome', '$Telefone', '$Email', '$Senha', " . $Admin . ")";

  if (mysqli_query($conexao, $sqlB)) {
    $msg = "Cliente registrado com sucesso!";
} else {
    $msg = "Erro ao inserir barbeiro: " . mysqli_error($conexao);
    header("Location: registrar_barbeiro.php?m=$msg"); // redireciona
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