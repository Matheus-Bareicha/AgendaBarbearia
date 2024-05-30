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

// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)

	
	$id = $_POST['id'];
	
	$Valor = $_POST['Valor'];
    $OBS = $_POST['Obs'];
	
		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS
			
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	//NSA

//5. CONECTAR NO BANCO DE DADOS

	
	
	

// 6. CRIAR SCRIPT SQL
	$sql = "UPDATE registro_financeiro
			SET
				Valor = '".$Valor."',
                Observacao = '".$OBS."'
				
			WHERE
				ID_Registro = ". $id;

	
	
// 7. EXECUTAR SCRIPT SQL
	$resultado = mysqli_query($conexao, $sql);
	
	if($resultado){
		
		
		// 11. FECHAR CONEXÃO COM O BD
		mysqli_close($conexao);
	
		$msg = "Estado do agendamento alterado com sucesso!";
		header("Location: financeiro.php?m=$msg");
	}
// 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS
	// NSA
	
// 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
	// NSA

// 10. APRESENTAR OS DADOS
	// NSA
	
// 11. FECHAR CONEXÃO COM O BD
	// NSA
	