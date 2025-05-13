<?php
    session_start();
    include_once './conexao.php';
    date_default_timezone_set('America/Sao_Paulo');

    // Verifica usuário logado
    if (empty($_SESSION['id'])) {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: você precisa estar logado para avaliar.</p>";
        header("Location: ./tela-login/login.php");
        exit;
    }

    // Recebe dados do formulário
    $id_usuario = $_SESSION['id'];
    $id_local   = filter_input(INPUT_POST, 'id_local', FILTER_VALIDATE_INT);
    $estrela    = filter_input(INPUT_POST, 'estrela', FILTER_VALIDATE_INT);
    $mensagem   = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

    // Validações básicas
    if (!$id_local || !$estrela) {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: dados inválidos.</p>";
        header("Location: local.php?id={$id_local}");
        exit;
    }

    try {
        // Prepara INSERT na tabela comentario
        $sql  = "INSERT INTO comentario 
                    (id_usuario, id_local, tipo_comentario, texto, avaliacao, data_comentario)
                VALUES 
                    (:id_usuario, :id_local, 'local', :texto, :avaliacao, :data_comentario)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_usuario',     $id_usuario,    PDO::PARAM_INT);
        $stmt->bindParam(':id_local',       $id_local,      PDO::PARAM_INT);
        $stmt->bindParam(':texto',          $mensagem,      PDO::PARAM_STR);
        $stmt->bindParam(':avaliacao',      $estrela,       PDO::PARAM_INT);
        $stmt->bindParam(':data_comentario', date("Y-m-d H:i:s"), PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "<p style='color: green;'>Avaliação cadastrada com sucesso.</p>";
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: não foi possível cadastrar a avaliação.</p>";
        }

    } catch (PDOException $e) {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro de banco: " . $e->getMessage() . "</p>";
    }

    // Redireciona de volta para a página do local
    header("Location: local.php?id={$id_local}");
    exit;

?>
