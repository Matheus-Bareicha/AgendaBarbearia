<?php
// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO

// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)

	
	$id = $_POST['id'];
	
	$estado = $_POST['estado'];
	
		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS	
			
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	//NSA

//5. CONECTAR NO BANCO DE DADOS
	$conexao = mysqli_connect("localhost", "root", "DPDF@2000", "leal");
	
	
	

// 6. CRIAR SCRIPT SQL
	$sql = "UPDATE agendamento
			SET
				Estado = '".$estado."'
				
			WHERE
				Id_Agendamento = ". $id;

	
	
// 7. EXECUTAR SCRIPT SQL
	$resultado = mysqli_query($conexao, $sql);
	
	if($resultado){
		
		
		// 11. FECHAR CONEXÃO COM O BD
		mysqli_close($conexao);
	
		$msg = "Estado do agendamento alterado com sucesso!";
		header("Location: pagina_barbeiro.php?m=$msg");
	}
// 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS
	// NSA
	
// 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
	// NSA

// 10. APRESENTAR OS DADOS
	// NSA
	
// 11. FECHAR CONEXÃO COM O BD
	// NSA
	