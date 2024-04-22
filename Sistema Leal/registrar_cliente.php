<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Registro de Cliente</title>
</head>
<body>
    
    <form action="cregistro_cliente.php" method="POST">
    <h1 id="marca">Sistema Leal</h1>

    <h2>Registro de Cliente</h2>
    <?php
    require_once ("config.php");
    
	if(isset($_GET['m'])){//existe conteúdo na variavel
	echo $_GET['m']; //imprimindo a msg de erro
	}
	?>
    <div class= "tabela-scroll" style= "max-height: 500px; min-width: 700px; overflow-x: hidden;">
        <label class="titulo" for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        
        <label class="titulo" for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br>
        
        <label class="titulo" for="email">Email:</label>
        <input type="text" id="email" name="email" required><br>
        
        <label class="titulo" for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        
        <label class="titulo" for="confirmasenha">Confirme a Senha:</label>
        <input type="password" id="confirmasenha" name="confirmasenha" required><br>

        <label class="titulo" for="uf">UF:</label>
        <select name="estado" id="uf" name="uf" required>
            <option value="" selected disabled>Selecione um estado</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
        </select><br/>
        
        <label class="titulo" for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required><br>
        </div>
        
        <input type="submit" value="Registrar">
        <a href="login_cliente.php">Voltar ao Início</a>


    </form>
</body>
</html>