<?php
// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
session_start();
	
	// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	if(!$_SESSION['LOGADO']){
		$msg = "Para acessar essa página é necessário realizar o Login";
		header("Location: login_funcionario.php?m=$msg");
		exit;
	}
// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS
	
	
	// 3.2. VERIFICAR SE AS SENHAS SÃO IGUAIS
		
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	//NSA

//5. CONECTAR NO BANCO DE DADOS
	$conexao = mysqli_connect("localhost", "root", "DPDF@2000", "leal");
	
	if($conexao == true){
	}else{
		echo "<p>Falha na conexão com o BD";
	}
	

// 6. CRIAR SCRIPT SQL
	$sql = "SELECT Horario, c.Nome as cliente,c.Telefone as Telefone, Estado, Id_Agendamento
         FROM agendamento a
         INNER JOIN cliente c 
         on a.C_CPF = c.CPF
		 WHERE id_agendamento = " . $_GET['i'];
	//echo $sql;
	
	
// 7. EXECUTAR SCRIPT SQL
	$resultado = mysqli_query($conexao, $sql);
		
// 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS

	# Converter o objeto do BD em array no php
	$arResultado = mysqli_fetch_assoc($resultado);

// 10. APRESENTAR OS DADOS
	
// 11. FECHAR CONEXÃO COM O BD
	mysqli_close($conexao);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Editar</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		
		<form method="post" action="cEditar.php">
			<h2>Editar Estado</h2>
			ID:<input readonly type="text" name="id" value="<?php echo $_GET['i']; ?>"><br/>
			Data: <input readonly  type="text" name="data" value="<?php echo date('d/m/Y', strtotime($arResultado['Horario']));?>"><br/>
			Horário: <input readonly  type="text" name="horario"  value="<?php echo date('H:i', strtotime($arResultado['Horario']));?>"><br/>			
			Cliente: <input readonly  type="text" name="cliente" value="<?php echo $arResultado['cliente'];?>"><br/>
			Telefone: <input readonly  type="text" name="Telefone" value="<?php echo $arResultado['Telefone'];?>"><br/>
			Estado:<select  name="estado" required>
					<option value="">Selecione um Estado</option>
					<option value="P">Pendente</option>
					<option value="C">Confirmado</option>
					<option value="R">Realizado</option>
					<option value="X">Cancelado</option>
					</select>
			<p>
				<input type="submit" value="ATUALIZAR">
			</p>
		</form>
	</body>
</html>