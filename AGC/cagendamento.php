<?php
// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	// N/A

// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
  $data = $_POST['data'];
  $horario = $_POST['horario'];
  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $barbeiro = $_POST['barbeiro'];





		
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS OBRIGATORIOS ESTÃO PREENCIDOS

	
		
// 4. TRATAR/PREPARAR OS DADOS PARA O BD
	 $dataFormatada = date('Y-m-d', strtotime($data));
	 $dataHora = $dataFormatada . ' ' . $horario;

	 $datual = new DateTime(date("Y-m-d H:i:s"));
	 $dcliente = new DateTime($dataHora);
	 if ($dcliente < $datual){
	 	$msg = "O horario do agendamento não pode ser anterior ao horario atual";
		header("Location: agendamento.php?m=$msg"); // redireciona
		exit();
}
//5. CONECTAR NO BANCO DE DADOS
	$conexao = mysqli_connect("localhost", "root", "", "agc");

	
	if(!$conexao){
	//if($conexao == false){
		$msg = "Erro ao conectar no BD.";
		header("Location: agendamento.php?m=$msg");
		exit();
	}
	

// 6. CRIAR SCRIPT SQL
	$sqlA = "SELECT 1 FROM agendamento WHERE b_login = '$barbeiro' AND horario = '$dataHora'";
	$sqlF = "SELECT 1 FROM folga WHERE b_login = '$barbeiro' AND  '$dataHora' BETWEEN inicio AND fim";

// 7. EXECUTAR SCRIPT SQL
	$resultadoA = mysqli_query($conexao, $sqlA);
	if (mysqli_num_rows($resultadoA) > 0) {
    // Horário conflitante com algum agendamento
		$msg = "O horário escolhido está indisponível devido a um agendamento existente.";
		header("Location: agendamento.php?m=$msg"); // redireciona
		exit();
} else {
    // Verificar conflito com folgas
    
    $resultadoF = mysqli_query($conexao, $sqlF);
    

    if ( mysqli_num_rows($resultadoF) > 0) {
        // Horário conflitante com uma folga
        $msg = "O horário escolhido está indisponível devido a uma folga do barbeiro.";
		header("Location: agendamento.php?m=$msg"); // redireciona
		exit();
        
    } else {

    	$sqlconcli = "SELECT 1 FROM cliente WHERE telefone = $telefone";
    	$resultadocc = mysqli_query($conexao, $sqlconcli);
    	if (mysqli_num_rows($resultadocc) <= 0){

    	 $sqlc = "INSERT INTO cliente
         (Nome, Telefone) 
         VALUES 
         ('$nome',$telefone);";

         if (mysqli_query($conexao, $sqlc)) {
        $msg = "O cliente foi registrado com sucesso.";
				
    } else {

        $msg = "Erro ao registrar o cliente";
				header("Location: agendamento.php?m=$msg"); // redireciona
				exit();
			}
		}



         
	}
	}
		 $sql = "INSERT INTO Agendamento
         (Horario, Estado, B_Login, C_Telefone) 
         VALUES 
         ('$dataHora', 'P', '$barbeiro', $telefone);";

	if (mysqli_query($conexao, $sql)) {
        $msg = "O agendamento foi registrado com sucesso.";
				
    } else {

        $msg = "Erro ao registrar o agendamento";
				header("Location: agendamento.php?m=$msg"); // redireciona
				exit();

    }


		
// 8. TRATAR DADOS RECUPERADOS DO BANCO DE DADOS	
		    //converter em array
		
		/*echo "<pre>";
		print_r($arResultado);
		echo "</pre>";
		*/
	
// 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
	

// 10. APRESENTAR OS DADOS
	
// 11. FECHAR CONEXÃO COM O BD
		 mysqli_close ($conexao);
		 header("Location: sucesso.php?m=$msg"); // redireciona
				exit();
	
?>









