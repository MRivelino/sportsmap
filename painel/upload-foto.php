<?php
session_start();
include_once 'conexao.php';  // ajuste o caminho conforme sua estrutura

// 1) Só usuários logados podem alterar a foto
if (empty($_SESSION['id'])) {
    die("Acesso negado.");
}

// 2) Recebe ID e arquivo
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    $_SESSION['msg'] = "ID de usuário inválido.";
    header("Location: conta.php");
    exit;
}
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['msg'] = "Selecione uma imagem válida.";
    header("Location: conta.php");
    exit;
}

// 3) Valida extensão
$ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
$allowed = ['jpg','jpeg','png','gif'];
if (!in_array($ext, $allowed)) {
    $_SESSION['msg'] = "Formato não permitido. Use jpg, png ou gif.";
    header("Location: conta.php");
    exit;
}

// 4) Monte o novo nome e caminho
$novoNome = "user_{$id}_" . time() . ".{$ext}";
$destino = __DIR__ . "/../images/{$novoNome}"; // ajusta conforme pasta images
$urlFoto = "../images/{$novoNome}";

// 5) Mova o arquivo
if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
    $_SESSION['msg'] = "Falha ao salvar a foto.";
    header("Location: conta.php");
    exit;
}

// 6) Atualize o banco
$sql = "UPDATE usuario SET foto = ? WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
if ($stmt->execute([$urlFoto, $id])) {
    $_SESSION['msg'] = "Foto de perfil atualizada!";
} else {
    $_SESSION['msg'] = "Erro ao atualizar o banco.";
}

// 7) Redirecione de volta
header("Location: conta.php");
exit;
