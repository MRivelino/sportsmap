<?php
session_start();
include_once './conexao.php';
date_default_timezone_set('America/Sao_Paulo');

// Verifica se usuário está logado
if (empty($_SESSION['id'])) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: você precisa estar logado para avaliar.</p>";
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id']; // Pega o ID do usuário logado

if (!empty($_POST['estrela'])) {
    $estrela = filter_input(INPUT_POST, 'estrela', FILTER_VALIDATE_INT);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

    $query_avaliacao = "
        INSERT INTO avaliacoes (id_usuario, qtd_estrela, mensagem, created) 
        VALUES (:id_usuario, :qtd_estrela, :mensagem, :created)
    ";

    $cad_avaliacao = $conn->prepare($query_avaliacao);

    $cad_avaliacao->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $cad_avaliacao->bindParam(':qtd_estrela', $estrela, PDO::PARAM_INT);
    $cad_avaliacao->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);
    $cad_avaliacao->bindValue(':created', date("Y-m-d H:i:s"), PDO::PARAM_STR);

    if ($cad_avaliacao->execute()) {
        $_SESSION['msg'] = "<p style='color: green;'>Avaliação cadastrada com sucesso.</p>";
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Avaliação não cadastrada.</p>";
    }

    header("Location: index.php");
    exit;
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar pelo menos 1 estrela.</p>";
    header("Location: index.php");
    exit;
}
?>
