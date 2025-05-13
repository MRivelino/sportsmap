<?php
	// Recuperando valor das variáveis do formulário
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$acao = $_POST["acao"];

	// Abrindo a conexão com o banco de dados
	$con = new mysqli("127.0.0.1:3306", "root", "", "db_sportsmap");
	
	// Verificando a conexão
	if ($con->connect_error) {
		die("Falha na conexão: " . $con->connect_error);
	}
	
	session_start(); // Inicia a sessão
	
	if ($acao == "c") { // Se a ação for para inserir (cadastrar)
		// Criptografando a senha
		$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

		// Preparando a consulta para inserir os dados de forma segura
		$sql = "INSERT INTO cliente (nome, email, senha) VALUES (?, ?, ?)";
		$res = $con->prepare($sql);
		
		if ($res === false) {
			die('Erro ao preparar a consulta: ' . $con->error);
		}

		// Vinculando os parâmetros
		$res->bind_param('sss', $nome, $email, $senhaHash);

		// Executando a consulta
		if ($res->execute()) {
			$_SESSION["aviso"] = "O cadastro foi efetuado com sucesso"; // Salva um aviso para ser impresso na página inicial
            header("Location: login.php"); // Redireciona de volta para a página inicial
		} else {
			die('Erro ao inserir dados: ' . $res->error);
		}

		// Fechando a consulta
		$res->close();
	}

	// Fechando a conexão com o banco de dados
	$con->close();
?>