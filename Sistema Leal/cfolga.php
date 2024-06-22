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
$dinicio = $_POST['dinicio'];
$dfim = $_POST['dfim'];
$hinicio = $_POST['hinicio'];
$hfim = $_POST['hfim'];
$b_login = $_SESSION['LOGIN'];

$inicio_nova_folga = $dinicio . ' ' . $hinicio;
$fim_nova_folga = $dfim . ' ' . $hfim;
		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS
	 if($dinicio == "" || $dfim == "" || $hinicio == "" || $dfim == ""){
		$msg = "Campos obrigatórios não preenchidos";
		header("Location: definir_horarios.php?m=$msg"); // redireciona
		exit();

	}
	elseif ($fim_nova_folga <= $inicio_nova_folga) {
		$msg = "Data ou horário invalidos";
		header("Location: definir_horarios.php?m=$msg"); // redireciona
		exit();
	}
	
	// 3.2. VERIFICAR SE AS SENHAS SÃO IGUAIS
		
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	//NSA

//5. CONECTAR NO BANCO DE DADOS


	if(!$conexao){
	//if($conexao == false){
		$msg = "Erro ao conectar no BD.";
		header("Location: pagina_barbeiro.php?m=$msg");
	}

// 6. CRIAR SCRIPT SQL
	$sql = "SELECT 1 FROM folga
	WHERE (('$inicio_nova_folga' >= Inicio AND '$inicio_nova_folga' < Fim)
	 OR ('$fim_nova_folga' > Inicio AND '$fim_nova_folga' <= Fim)
	 OR ('$inicio_nova_folga' <= Inicio AND '$fim_nova_folga' >= Fim))
	  AND '$b_login' = b_Email";
	
	 
// 7. EXECUTAR SCRIPT SQL
		    $resultado = mysqli_query($conexao, $sql);
		    if(!$resultado){
				$msg = "Erro na consulta";
				header("Location: definir_horarios.php?m=$msg"); // redireciona
				exit();

			}
			else {
				if (mysqli_num_rows($resultado) > 0) {
					$msg = "Já existe uma folga no período selecionado.";
				header("Location: definir_horarios.php?m=$msg"); // redireciona
				exit();

}else {

    $b_login = $_SESSION['LOGIN'];
    $insertSql = "INSERT INTO folga(Inicio, Fim, b_Email) VALUES ('$inicio_nova_folga', '$fim_nova_folga', '$b_login')";

    if (mysqli_query($conexao, $insertSql)) {
        $msg = "A folga foi inserida com sucesso.";
				
    } else {

        $msg = "Erro ao inserir a folga";
				header("Location: definir_horarios.php?m=$msg"); // redireciona
				exit();

    }
}


}
		
// 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS
		    //converter em array
// 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
	

// 10. APRESENTAR OS DADOS
	
// 11. FECHAR CONEXÃO COM O BD
		 mysqli_close ($conexao);
		 header("Location: pagina_barbeiro.php?m=$msg"); // redireciona
				exit();
	
