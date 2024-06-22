<?php
        session_start();
        if(!$_SESSION['LOGADO'] || $_SESSION['TIPO']!=0){
            $msg = "Para acessar essa página é necessário realizar o Login";
            header("Location: login_funcionario.php?m=$msg");
            exit;
        }
require_once "config.php";

// Média de agendamentos por mês
$sqlMediaAgendamentos = "
SELECT AVG(TotalAgendamentos) AS MediaMensal
FROM (
    SELECT COUNT(*) AS TotalAgendamentos
    FROM agendamento
    WHERE Estado = 'C'
    GROUP BY YEAR(Horario), MONTH(Horario)
) AS AgendamentosMensais
";
$resultadoMedia = mysqli_query($conexao, $sqlMediaAgendamentos);
$mediaMensal = 0;
if (mysqli_num_rows($resultadoMedia) > 0) {
$row = mysqli_fetch_assoc($resultadoMedia);
$mediaMensal = $row['MediaMensal'];
}

// Dia da semana com mais agendamentos
$sqlMaisAgendamentos = "
SELECT
    DAYOFWEEK(Horario) AS DiaSemana,
    COUNT(*) AS TotalAgendamentos
FROM
    agendamento
WHERE
    Estado = 'C'
GROUP BY
    DiaSemana
ORDER BY
    TotalAgendamentos DESC
LIMIT 1
";
$resultadoMais = mysqli_query($conexao, $sqlMaisAgendamentos);
$diaMaisAgendamentos = "";
if (mysqli_num_rows($resultadoMais) > 0) {
$row = mysqli_fetch_assoc($resultadoMais);
$diaMaisAgendamentos = $row['DiaSemana'];
}

// Dia da semana com menos agendamentos
$sqlMenosAgendamentos = "
SELECT
    DAYOFWEEK(Horario) AS DiaSemana,
    COUNT(*) AS TotalAgendamentos
FROM
    agendamento
WHERE
    Estado = 'C'
GROUP BY
    DiaSemana
ORDER BY
    TotalAgendamentos ASC
LIMIT 1
";
$resultadoMenos = mysqli_query($conexao, $sqlMenosAgendamentos);
$diaMenosAgendamentos = "";
if (mysqli_num_rows($resultadoMenos) > 0) {
$row = mysqli_fetch_assoc($resultadoMenos);
$diaMenosAgendamentos = $row['DiaSemana'];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Página do Barbeiro</title>
<link rel="stylesheet" type="text/css" href= "styles.css">
</head>
<body>
<form action="" method="post">
    <h1 id="marca">Sistema Leal</h1>

    <?php
    if(isset($_GET['m'])) {
            echo "<h2>" . $_GET['m'] . "</h2>"; // imprimindo a msg de erro
        }
    ?>

    <h2>Estatísticas:</h2>
    <div class="estatisticas">
            <div class="estatistica">
                <p class="titulo">Média de agendamentos por mês</p>
                <p><?php echo number_format($mediaMensal, 2); ?></p>
            </div>
            <div class="estatistica">
                <p class="titulo">Dia da semana com mais agendamentos</p>
                <p><?php echo $diaMaisAgendamentos; ?></p>
            </div>
            <div class="estatistica">
                <p class="titulo">Dia da semana com menos agendamentos</p>
                <p><?php echo $diaMenosAgendamentos; ?></p>
            </div>
        </div>


        <h2>Selecione uma opção:</h2>

        <div class="botoes">
            <div class="coluna">
                <input type="submit" formaction="agendados.php" value="Agenda">
                <input type="submit" formaction="estoque.php" value="Estoque">
                <input type="submit" formaction="definir_horarios.php" value="Registrar Folga">
                <input type="submit" formaction="registrar_servico.php" value="Registrar Serviço">
            </div>
            <div class="coluna">
                <input type="submit" formaction="financeiro.php" value="Financeiro">
                <input type="submit" formaction="alterar_dados_barbeiro.php" value="Editar Dados">
                <input type="submit" formaction="encomendas.php" value="Encomendas">
                <?php if($_SESSION['ADMIN']) { ?>
                    <input type="submit" formaction="registrar_barbeiro.php" value="Registrar Funcionário">
                <?php } ?>
            </div>
        </div>

		<a href="clogout.php">SAIR</a>
	    </form>
</body>
</html>
