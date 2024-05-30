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
// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO

// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)

	
	$Email = $_POST['Email'];
	$EmailVelho = $_POST['EmailVelho'];
	$Telefone = $_POST['Telefone'];
	
		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS
			
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	//NSA

//5. CONECTAR NO BANCO DE DADOS

	
	
	

// 6. CRIAR SCRIPT SQL
	$sql = "UPDATE cliente SET Telefone = '".$Telefone."', Email = '".$Email."' WHERE Email = '".$EmailVelho ."'";

	
	
// 7. EXECUTAR SCRIPT SQL
	$resultado = mysqli_query($conexao, $sql);
	
	if($resultado){
		
		
		// 11. FECHAR CONEXÃO COM O BD
		mysqli_close($conexao);
		$_SESSION['LOGIN'] = $Email;
		$_SESSION['TELEFONE'] = $Telefone;
	
		$msg = "Dados alterado com sucesso!";
		header("Location: pagina_cliente.php?m=$msg");
	}
// 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS
	// NSA
	
// 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
	// NSA

// 10. APRESENTAR OS DADOS
	// NSA
	
// 11. FECHAR CONEXÃO COM O BD
	// NSA
	