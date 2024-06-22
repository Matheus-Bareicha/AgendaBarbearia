<?php
session_start();
if (!$_SESSION['LOGADO'] || $_SESSION['TIPO'] != 1) {
    $msg = "Para acessar essa página é necessário realizar o Login como cliente";
    header("Location: login_cliente.php?m=$msg");
    exit;
}

require_once "config.php";

$login = $_SESSION['LOGIN'];

$data = date('Y-m-d');
if (isset($_POST['d']) && $_POST['d'] != '') {
    $data = $_POST['d'];
}

// Consulta para encomendas do cliente logado
$sqlEncomendas = "
    SELECT r.c_Email, c.Nome as Cliente, r.Estoque_IDProduto, r.Data, r.QTD, r.Estado, e.Nome, e.Preco
    FROM reserva r
    JOIN estoque e ON r.Estoque_IDProduto = e.IDProduto
    JOIN cliente c ON r.c_email = c.email
    WHERE r.c_email = '$login' AND DATE(r.Data) = '$data'
    ORDER BY r.Data
";
$resultEncomendas = mysqli_query($conexao, $sqlEncomendas);

// Consulta para agendamentos do cliente logado
$sqlAgendamentos = "
    SELECT a.Horario, a.Estado, b.Nome as Barbeiro
    FROM agendamento a
    INNER JOIN barbeiro b on a.b_Email = b.Email
    WHERE a.C_Email = '$login'
    ORDER BY a.Horario
";
$resultAgendamentos = mysqli_query($conexao, $sqlAgendamentos);

if (!$resultEncomendas || !$resultAgendamentos) {
    $msg = "Erro na consulta";
    header("Location: pagina_cliente.php?m=$msg");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Minhas Encomendas e Agendamentos</title>
    <style>
        .section {
            margin-bottom: 20px;
        }
        .tabela-scroll {
            max-height: 500px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bodytabela">
    <form action="encomendas_agendamentos.php" method="post">
        <h1 id="marca">Sistema Leal</h1>

        <h2>Minhas Encomendas</h2>
        <?php
        if (isset($_GET['m'])) {
            echo "<p>" . $_GET['m'] . "</p>"; // imprimindo a msg de erro
        }
        ?>
        <div class="tabela-scroll" style="min-width: 700px; overflow-x: hidden;">
            <table border='1'>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Data</th>
                    <th>Quantidade</th>
                    <th>Estado</th>
                </tr>
                <?php
                if (mysqli_num_rows($resultEncomendas) > 0) {
                    while ($row = mysqli_fetch_assoc($resultEncomendas)) {
                        echo "<tr>";
                        echo "<td>" . $row['Nome'] . "</td>";
                        echo "<td>" . $row['Preco'] * $row['QTD'] . "</td>"; // Multiplica o preço pela quantidade
                        echo "<td>" . $row['Data'] . "</td>";
                        echo "<td>" . $row['QTD'] . "</td>";
                        echo "<td>" . $row['Estado'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma encomenda encontrada</td></tr>";
                }
                ?>
            </table>
        </div>

        <h2>Meus Agendamentos</h2>
        <div class="tabela-scroll" style="min-width: 700px; overflow-x: hidden;">
            <table border='1'>
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Barbeiro</th>
                    <th>Estado</th>
                </tr>
                <?php
                if (mysqli_num_rows($resultAgendamentos) > 0) {
                    while ($row = mysqli_fetch_assoc($resultAgendamentos)) {
                        echo "<tr>";
                        echo "<td>" . date('d/m/Y', strtotime($row['Horario'])) . "</td>";
                        echo "<td>" . date('H:i', strtotime($row['Horario'])) . "</td>";
                        echo "<td>" . $row['Barbeiro'] . "</td>";
                        echo "<td>" . $row['Estado'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum agendamento encontrado</td></tr>";
                }
                ?>
            </table>
        </div>

        <br/>
        <a href="pagina_cliente.php">Voltar ao Início</a>
    </form>
</body>
</html>

<?php
mysqli_close($conexao);
?>
