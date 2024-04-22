<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Página do Barbeiro</title>
    <style>
        html, body {
            height: 100%;
        }

        body {
            background-color: #F5DEB3;
            margin: 0;
        }

        #marca {
            display: flex;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            margin: 20px 0;
            text-align: center;
            color: #662000;
            font-size: 48px;
            font-family: "";
        }

        .tabela-scroll {
            max-height: 600px;
            min-width: 700px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: auto;
            width: 50%;
            height: 94%;
            min-height: 300px;
            padding: 20px;
            background-color: #FFE4B5;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .divpilar {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px;
        }

        .coluna {
            width: 50%;
        }

        input[type="submit"] {
            display: block;
            padding: 10px;
            margin: 10px auto;
            background-color: #8B4513;
            color: #fff;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            line-height: 1.5;
            width: 200px;
        }

        input[type="submit"]:hover {
            background-color: #A0522D;
        }

        h2, .titulo {
            font-size: 24px;
            color: #8B4513;
            margin: 20px 0;
            font-family: "";
        }

        body.sucesso {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
            max-width: 600px;
        }

        th {
            background-color: #754C29;
            color: #F7F4E9;
            font-weight: bold;
            padding: 10px;
        }

        td {
            background-color: #F7F4E9;
            color: #754C29;
            padding: 10px;
            text-align: center;
        }

        td:first-child {
            font-weight: bold;
        }

        .bodytabela {
            font-family: Arial, sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1 id="marca">A Caverna Barbershop</h1>
        <?php
            if(isset($_GET['m'])) {
                echo "<h2>" . $_GET['m'] . "</h2>"; //imprimindo a msg de erro
            }
        ?>
        <h2>Selecione uma opção:</h2>
        <div class="divpilar">
            <div class="coluna">
                <input type="submit" formaction="agendados.php" value="Agenda">
                <input type="submit" formaction="#" value="Estoque" disabled>
                <input type="submit" formaction="definir_horarios.php" value="Registrar Folga">
                <input type="submit" formaction="#" value="Registrar Serviço" disabled>
            </div>
            <div class="coluna">
                <input type="submit" formaction="#" value="Registrar Funcionário"disabled>
                <input type="submit" formaction="financeiro.php" value="Financeiro">
                <input type="submit" formaction="#" value="Editar Dados" disabled>
                <input type="submit" formaction="#" value="Encomendas" disabled>
            </div>
        </div>
		<a href="clogout.php">SAIR</a>
	    </form>
</body>
</html>
