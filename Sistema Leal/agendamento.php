<?php
session_start();
if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!= 1){
    $msg = "Para acessar essa página é necessário realizar o Login como cliente";
    header("Location: login_cliente.php?m=$msg");
    exit;
}

require_once "config.php";
$nome = $_SESSION['NOME'];
$Email = $_SESSION['LOGIN'];


  if(!$conexao){
    $msg = "Erro ao conectar no BD.";
    header("Location: pagina_cliente.php?m=$msg");
  }

//buscando os barbeiros
$sqlBarbeiro =  "SELECT Nome, Email
         FROM barbeiro";

$resultadoBarbeiro = mysqli_query($conexao, $sqlBarbeiro);

//buscondo os servicos
$sqlServico =  "SELECT ID, Nome, Valor
		 FROM servicos";

$resultadoServico = mysqli_query($conexao, $sqlServico);


mysqli_close($conexao);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Agendamento</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<form action="cagendamento.php" method="post">
		<h1 id="marca">Sistema Leal</h1>
		<h2>Agendamento</h2>
		<?php
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}
	?>
		<label for="data" class="titulo">Data:</label>
		<input type="date"  name="data" required>
		<label for="horario" class="titulo">Horário:</label>
		<select  name="horario" required>
			<option value="">Selecione um horário</option>
			<option value="09:00">09:00</option>
			<option value="10:00">10:00</option>
			<option value="11:00">11:00</option>
			<option value="14:00">14:00</option>
			<option value="15:00">15:00</option>
			<option value="16:00">16:00</option>
			<option value="17:00">17:00</option>
			<option value="18:00">18:00</option>
			<option value="19:00">19:00</option>
			<option value="20:00">20:00</option>

		</select>
		<?php
		if ($_SESSION['LOGADO']){
			?>
			<label for="nome" class="titulo">Nome:</label>
			<input type="text" name="nome" value="<?php echo $nome; ?>" disabled>
			<label for="Email" class="titulo">Email:</label>
			<input type="text" name="Email" value="<?php echo $Email; ?>" disabled>
		<?php
		}else{
		
		
		?>
		<label for="nome" class="titulo">Nome:</label>
		<input type="text" name="nome" required>
		<label for="Email" class="titulo">Email:</label>
		<input type="text" name="Email" required>
		<?php
		}
		?>
		<label for="horario" class="titulo">Barbeiro:</label>
		<select name="barbeiro" required>
			<option value="">Selecione um Barbeiro</option>
<?php
    while($arResultado = mysqli_fetch_assoc($resultadoBarbeiro)){
  ?>
			<option value="<?php echo $arResultado['Email'];?>"><?php echo $arResultado['Nome'];?></option>
<?php
    }
  ?>
			
		</select>
		
		<table>
			<tr>
				<th>Serviço</th>
				<th>Valor</th>
				<th>Selecionar</th>
			</tr>
<?php
	while($arResultado = mysqli_fetch_assoc($resultadoServico)){
?>
			<tr>
				<td><?php echo $arResultado['Nome'];?></td>
				<td><?php echo $arResultado['Valor'];?></td>
			
				<td><input type="checkbox" name="servico[]" value="<?php echo $arResultado['ID'];?>"></td>
			</tr>
<?php
	}
?>
		</table>

		<input type="submit" value="Agendar">

		<a href="pagina_cliente.php">Voltar ao Início</a>
	
	</form>
</body>
</html>

