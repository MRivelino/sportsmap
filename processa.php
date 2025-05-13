<?php
    session_start();

    include_once './conexao.php';

    date_default_timezone_set('America/Sao_Paulo');

    if(!empty($_POST['estrela'])){
        $estrela = filter_input(INPUT_POST, 'estrela', FILTER_DEFAULT);
        $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_DEFAULT);
        
        
        $query_avaliacao = "INSERT INTO avaliacoes (qtd_estrela, mensagem, created) VALUES (:qtd_estrela, :mensagem, :created)";

        $cad_avaliacao = $conn->prepare($query_avaliacao);
        
        $cad_avaliacao->bindParam(':qtd_estrela', $estrela, PDO::PARAM_INT);
        $cad_avaliacao->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);
        $cad_avaliacao->bindParam(':created', date("Y-m-d H:i:s"));

        if($cad_avaliacao->execute()){
            $_SESSION['msg'] = "<p style='color: green;'>Avaliação cadastrada com sucesso.</p>";

            header("Location: index.php");
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Avaliação não cadastrada.</p>";

            header("Location: index.php");
        }
    } else{
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar pelo menos 1 estrela.</p>";

        header("Location: index.php");
    }
?>