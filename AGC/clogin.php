<?php
// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO

// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
$login = $_POST['usuario'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];
		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS
	 if($login == "" OR $senha == ""){
		$msg = "Campos obrigatórios não preenchidos";
		header("Location: login_funcionario.php?m=$msg"); // redireciona
		exit();
	}	
	
	// 3.2. VERIFICAR SE AS SENHAS SÃO IGUAIS
		
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	//NSA

//5. CONECTAR NO BANCO DE DADOS
	$conexao = mysqli_connect("localhost", "root", "", "agc");

	if(!$conexao){
	//if($conexao == false){
		$msg = "Erro ao conectar no BD.";
		header("Location: login_funcionario.php?m=$msg");
	}
$sql;
// 6. CRIAR SCRIPT SQL
if($tipo == 0){
	$sql = "SELECT
			login,
			senha,
			nome
		    FROM barbeiro
		    WHERE  login = '$login';";
}elseif($tipo == 1){
	$sql = "SELECT
			email,
			senha,
			nome
		    FROM cliente
		    WHERE  email = '$login';";

}
	
// 7. EXECUTAR SCRIPT SQL
		    $resultado = mysqli_query($conexao, $sql);
		
// 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS	
		    //converter em array
		$arResultado = mysqli_fetch_assoc($resultado);
		/*echo "<pre>";
		print_r($arResultado);
		echo "</pre>";
		*/
	
// 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
if ($tipo == 0){
		if($senha == $arResultado['senha']){
		// JÁ SEI QUE TÁ LOGADO
		session_start(); // inicia o uso SESSION
		$_SESSION['LOGADO'] = true;
		$_SESSION['LOGIN'] = $arResultado['login'];
				
		$msg = "<p> Seja bem vindo " . $arResultado['nome'];
		//header("Location: home.php?m=$msg");
		// VERIFICAR O PERFIL DO USUÁRIO LOGADO
		
			header("Location: pagina_barbeiro.php?m=$msg");
			exit;
		
	}else{
		$msg = "Usuário ou senha incorretos.";
		header("Location: login_funcionario.php?m=$msg");
		exit();
	}}elseif($tipo == 1){

		if($senha == $arResultado['senha']){
			session_start(); // inicia o uso SESSION
			$_SESSION['LOGADO'] = true;
			$_SESSION['LOGIN'] = $arResultado['login'];
			$_SESSION['tipo'] = $tipo;
					
			$msg = "<p> Seja bem vindo " . $arResultado['nome'];
			//header("Location: home.php?m=$msg");
			
				header("Location: pagina_cliente.php?m=$msg");
				exit;
			
		}else{
			$msg = "Usuário ou senha incorretos.";
			header("Location: login_cliente.php?m=$msg");
			exit();


	}}

// 10. APRESENTAR OS DADOS
	
// 11. FECHAR CONEXÃO COM O BD
		 mysqli_close ($conexao);
	
?>