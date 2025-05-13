<?php 
require_once 'header.php'; 
require_once 'conect.php'; 
session_start(); 

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) { 
    header('Location: ../tela-login/login.php'); 
    exit; 
} 

// Busca informações do usuário no banco de dados usando MySQLi
$id_usuario = $_SESSION['id']; 
$sql = "SELECT nome, email FROM usuario WHERE id_usuario = ?"; 

if ($stmt = $con->prepare($sql)) { 
    $stmt->bind_param('i', $id_usuario); 
    $stmt->execute(); 
    $stmt->bind_result($nome, $email); 

    if ($stmt->fetch()) { 
        $user = ['nome' => $nome, 'email' => $email]; 
    } else { 
        echo "<p>Usuário não encontrado.</p>"; 
        exit; 
    } 

    $stmt->close(); 
} else { 
    die('Erro na consulta: ' . $con->error); 
} 
?>  

<?php require_once 'nav.php'; ?> 

<div class="profile-container" style="max-width: 600px; margin: 40px auto; padding: 20px; margin-top: 8em;">
    <h2 style="text-align: center; font-family: 'Arial', sans-serif; color: #333;">Perfil do Usuário</h2>
    <div class="profile-card" style="display: flex; align-items: center; gap: 20px; background: #f9f9f9; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <div class="photo" style="flex: 0 0 120px; display: flex; justify-content: center; align-items: center; background-color: #ccc; border-radius: 50%; width: 120px; height: 120px; overflow: hidden;">
            <!-- Circulo representando o avatar -->
            <div style="width: 100px; height: 100px; background-color: #f0f0f0; border-radius: 50%; display: flex; justify-content: center; align-items: center; color: #999; font-size: 20px; font-weight: bold;">
                <span>?</span>
            </div>
        </div>
        <div class="info" style="flex: 1;">
            <p style="font-size: 18px; margin: 5px 0; color: #333;"><strong>Nome:</strong> <?= htmlspecialchars($user['nome']); ?></p>
            <p style="font-size: 18px; margin: 5px 0; color: #555;"><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
        </div>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="../painel/index.php" class="btn btn-secondary" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; transition: background-color 0.3s ease;">Voltar</a>
        <a href="logout.php" class="btn btn-danger" style="background-color: #dc3545; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; transition: background-color 0.3s ease; margin-left: 15px;">Sair</a>
    </div>
</div>

<?php require_once 'footer.php'; ?>
