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
$sql = "SELECT nome, email, foto FROM usuario WHERE id_usuario = ?";

if ($stmt = $con->prepare($sql)) { 
    $stmt->bind_param('i', $id_usuario); 
    $stmt->execute(); 
    $stmt->bind_result($nome, $email, $foto); 

    if ($stmt->fetch()) { 
        $user = ['nome' => $nome, 'email' => $email, 'foto' => $foto]; 
    } else { 
        echo "<p>Usuário não encontrado.</p>"; 
        exit; 
    } 

    $stmt->close(); 
} else { 
    die('Erro na consulta: ' . $con->error); 
} 
?>  

<style>
.photo {
  position: relative;
  width: 120px;
  height: 120px;
  border-radius: 50%;
  overflow: hidden;
  cursor: pointer;
}

.photo img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.photo .overlay {
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0);
  transition: background 0.3s ease;
}

.photo .edit-icon {
  position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  color: #fff;
  font-size: 24px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.photo:hover .overlay {
  background: rgba(0,0,0,0.4);
}
.photo:hover .edit-icon {
  opacity: 1;
}
</style>

<?php require_once 'nav.php'; ?> 

<div class="profile-container" style="max-width: 600px; margin: 40px auto; padding: 20px; margin-top: 8em;">
    <h2 style="text-align: center; font-family: 'Arial', sans-serif; color: #333;">Perfil do Usuário</h2>
    <div class="profile-card" style="display: flex; align-items: center; gap: 20px; background: #f9f9f9; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <div class="photo" id="photo-container" style="position: relative; flex: 0 0 120px; width: 120px; height: 120px; border-radius: 50%; overflow: hidden; cursor: pointer;">
            <img
                src="<?= htmlspecialchars($user['foto']); ?>"
                alt="Foto do usuário"
                id="user-photo"
                style="width: 100%; height: 100%; object-fit: cover;"
            >

            <!-- overlay escuro (invisível até hover) -->
            <div class="overlay"></div>

            <!-- ícone de lápis -->
            <div class="edit-icon">
                <i class="fa fa-pencil"></i>
            </div>

            <!-- Formulário de upload -->
            <form id="uploadForm" action="upload-foto.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
                <input type="file" name="foto" id="fileInput" accept="image/*" style="display:none;">
            </form>
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

<script>
  const photoContainer = document.getElementById('photo-container');
  const fileInput      = document.getElementById('fileInput');
  const uploadForm     = document.getElementById('uploadForm');
  const userPhoto      = document.getElementById('user-photo');

  // ao clicar no container, dispara o file input
  photoContainer.addEventListener('click', () => {
    fileInput.click();
  });

  // quando o usuário escolher um arquivo, submete o form
  fileInput.addEventListener('change', () => {
    if (fileInput.files.length) {
      // opcional: mostrar preview imediato
      const reader = new FileReader();
      reader.onload = e => userPhoto.src = e.target.result;
      reader.readAsDataURL(fileInput.files[0]);

      // submete o formulário após trocar o src
      uploadForm.submit();
    }
  });
</script>

