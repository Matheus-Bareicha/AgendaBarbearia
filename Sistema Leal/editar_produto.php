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
		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS
	
	
	// 3.2. VERIFICAR SE AS SENHAS SÃO IGUAIS
		
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	//NSA

//5. CONECTAR NO BANCO DE DADOS

	
	if(!$conexao){
			$msg = "Erro ao conectar no BD.";
			header("Location: estoque.php?m=$msg");
			exit();
	}
	

// 6. CRIAR SCRIPT SQL
	$sql = "SELECT *
         FROM estoque
		 WHERE IDProduto = " . $_GET['i'];

	
	
// 7. EXECUTAR SCRIPT SQL
	$resultado = mysqli_query($conexao, $sql);

	if(!$resultado){
		$msg = "Erro ao executar o comando SQL";
		header("Location: estoque.php?m=$msg");
		exit();
	}
		
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
		
		<form method="post" action="cEditar_produto.php">
			<h2>Editar Estado</h2>
            ID Produto: <input readonly type="text" name="id" value="<?php echo $_GET['i']; ?>"><br/>
            Nome: <input type="text" name="nome" value="<?php echo $arResultado['Nome'];?>"><br/>
            Quantidade: <input type="text" name="quantidade" value="<?php echo $arResultado['Quantidade'];?>"><br/>
            Quantidade para Alerta: <input type="text" name="qtd_alerta" value="<?php echo $arResultado['QTD_Alerta'];?>"><br/>
            Preço: <input type="text" name="preco" value="<?php echo $arResultado['Preco'];?>"><br/>
            Minimo para Venda: <input type="text" name="limite_venda" value="<?php echo $arResultado['LIM_Venda'];?>"><br/>
            Promoção: <input type="text" name="promocao" value="<?php echo $arResultado['Promocao'];?>"><br/>
            <p>
				<input type="submit" value="ATUALIZAR">
			</p>
            <a href="estoque.php">Voltar</a>
		</form>
	</body>
</html>