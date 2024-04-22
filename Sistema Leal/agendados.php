<?php
require_once ("config.php");
  session_start();
  
  // 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
  if(!$_SESSION['LOGADO']){
    $msg = "Para acessar essa página é necessário realizar o Login";
    header("Location: login_funcionario.php?m=$msg");
    exit;
  }
$data = "curdate()";
$login = $_SESSION['LOGIN'];
if(isset($_POST['d'])){
  $data =  "'" . $_POST['d'] . "'";
  }




  if(!$conexao){
  //if($conexao == false){
    $msg = "Erro ao conectar no BD.";
    header("Location: login_funcionario.php?m=$msg");
  }


$sql =  "SELECT Horario, c.Nome as cliente,c.Telefone as Telefone, Estado, Id_Agendamento
         FROM agendamento a
         INNER JOIN cliente c
         on a.C_CPF= c.CPF
         INNER JOIN barbeiro b on a.b_Email = b.Email
         WHERE b_Email = '$login' AND DATE(horario) = $data";


$resultado = mysqli_query($conexao, $sql);
        if(!$resultado){
        $msg = "Erro na consulta";
        header("Location: definir_horarios.php?m=$msg"); // redireciona
        exit();

      }






?>

















<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title>Agendamentos</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="bodytabela">
	
	
  <form action="agendados.php" method="post">
	<h1 id="marca">A Caverna Barbershop</h1>
	<h2>Agendamentos</h2>
  <?php
  if (mysqli_num_rows($resultado) > 0) {

  ?>
  <div class = "tabela-scroll">
	<table border="1px">
  <tr>
    <th>Data</th>
    <th>Horário</th>
    <th>Cliente</th>
    <th>Telefone</th>
    <th>Estado</th>
    <th>Alterar Estado</th>
  </tr>
  <?php
    while($arResultado = mysqli_fetch_assoc($resultado)){




  ?>
  <tr>
    <td><?php echo date('d/m/Y', strtotime($arResultado['Horario']));?></td>
    <td><?php echo date('H:i', strtotime($arResultado['Horario']));?></td>
    <td><?php echo $arResultado['cliente'];?></td>
    <td><?php echo $arResultado['Telefone'];?></td>
    <td><?php echo $arResultado['Estado'];?></td>
    <td><a href="editar.php?i=<?php echo $arResultado['Id_Agendamento']; ?>">Alterar</a></td>
  </tr>
  

<?php

}
mysqli_close($conexao);
?>
</table>
</div>
<?php
}else {
    echo "Nenhum resultado encontrado.";
    mysqli_close($conexao);
}

 ?>
 
   <input type="date" name="d">
   <input type="submit" name="Filtrar Data" value="Filtrar Data">

   <a href="pagina_barbeiro.php">Voltar ao Início</a>
 </form>


</body>
</html>
