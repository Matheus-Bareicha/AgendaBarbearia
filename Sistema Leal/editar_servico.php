<?php
	session_start();
	if(!$_SESSION['LOGADO'] || $_SESSION['TIPO'] != 0){
		$msg = "Para acessar essa página é necessário realizar o Login como barbeiro";
		header("Location: login_funcionario.php?m=$msg");
		exit;
	}

	require_once "config.php";

	// Verifica se foi passado um parâmetro ID na URL
	if(isset($_GET['id'])) {
		$id = $_GET['id'];

		// Consulta SQL para selecionar o serviço com base no ID
		$sql = "SELECT * FROM servicos WHERE ID = $id";
		$resultado = mysqli_query($conexao, $sql);

		if(mysqli_num_rows($resultado) == 1) {
			// Recupera os dados do serviço
			$servico = mysqli_fetch_assoc($resultado);
		} else {
			$msg = "Serviço não encontrado";
			header("Location: pagina_barbeiro.php?m=$msg");
			exit;
		}
	} else {
		$msg = "ID do serviço não especificado";
		header("Location: pagina_barbeiro.php?m=$msg");
		exit;
	}

	mysqli_close($conexao);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Serviço</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	
	<form method="post" action="cEditar_Servico.php">
		<h2>Editar Serviço</h2>
		<input type="hidden" name="id" value="<?php echo $servico['ID']; ?>">
		
		<label for="nome">Nome:</label>
		<input type="text" id="nome" name="nome" value="<?php echo $servico['Nome']; ?>" required><br>
		
		<label for="valor">Valor:</label>
		<input type="text" id="valor" name="valor" value="<?php echo $servico['Valor']; ?>" required><br>
		
		<label for="duracao">Duração:</label>
		<input type="text" id="duracao" name="duracao" value="<?php echo $servico['Duracao']; ?>" required><br>

		<input type="submit" value="Atualizar">
		<a href="registrar_servico.php">Cancelar</a>
	</form>

</body>
</html>
