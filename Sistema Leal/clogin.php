<?php
require_once ("config.php");
// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO

// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
$login = $_POST['usuario'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];
		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS
	 if($login == "" || $senha == ""){
		$msg = "Campos obrigatórios não preenchidos";
		header("Location: index.php?m=$msg"); // redireciona
		exit();
	}
	
	// 3.2. VERIFICAR SE AS SENHAS SÃO IGUAIS
		
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	//NSA

//5. CONECTAR NO BANCO DE DADOS


	if(!$conexao){
	//if($conexao == false){
		$msg = "Erro ao conectar no BD.";
		header("Location: index.php?m=$msg");
	}
$sql;
// 6. CRIAR SCRIPT SQL
if($tipo == 0){
	$sql = "SELECT
			Email,
			Senha,
			Nome,
			Admin
		    FROM barbeiro
		    WHERE  Email = '$login';";
}elseif($tipo == 1){
	$sql = "SELECT
			Email,
			Senha,
			Nome,
			Telefone
		    FROM cliente
		    WHERE  Email = '$login';";

}
	
// 7. EXECUTAR SCRIPT SQL
		    $resultado = mysqli_query($conexao, $sql);
		
// 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS
		    //converter em array
		$arResultado = mysqli_fetch_assoc($resultado);

	

// 8.1 DESABILITAR SESSAO ANTERIOR
		session_start(); // inicia o uso SESSION
		unset($_SESSION['LOGADO']);
		unset($_SESSION['LOGIN']);
		unset($_SESSION['tipo']);
		unset($_SESSION['ADMIN']);
		unset($_SESSION['NOME']);
		unset($_SESSION['TELEFONE']);
// 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
if ($tipo == 0){
		if($senha == $arResultado['Senha']){
		// JÁ SEI QUE TÁ LOGADO

		$_SESSION['LOGADO'] = true;
		
		$_SESSION['LOGIN'] = $arResultado['Email'];
		
		$_SESSION['TIPO'] = $tipo;
		$_SESSION['ADMIN'] = $arResultado['Admin'];
				
		$msg = "<p> Seja bem vindo " . $arResultado['Nome'];
		//header("Location: home.php?m=$msg");
		// VERIFICAR O PERFIL DO USUÁRIO LOGADO
		
			header("Location: pagina_barbeiro.php?m=$msg");
			exit;
		
	}else{
		$msg = "Usuário ou senha incorretos.";
		header("Location: login_funcionario.php?m=$msg");
		exit();
	}
}elseif($tipo == 1){

		if($senha == $arResultado['Senha']){
			$_SESSION['LOGADO'] = true;
			$_SESSION['LOGIN'] = $arResultado['Email'];
			$_SESSION['TIPO'] = $tipo;
			$_SESSION['NOME'] = $arResultado['Nome'];
			$_SESSION['TELEFONE'] = $arResultado['Telefone'];

					
			$msg = "<p> Seja bem vindo " . $arResultado['Nome'];
			
				header("Location: pagina_cliente.php?m=$msg");
				exit;
			
		}else{
			$msg = "Usuário ou senha incorretos.";
			header("Location: login_cliente.php?m=$msg");
			exit();


	}
}

// 10. APRESENTAR OS DADOS
	
// 11. FECHAR CONEXÃO COM O BD
		 mysqli_close ($conexao);
	
