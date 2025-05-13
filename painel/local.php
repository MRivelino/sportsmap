<?php
// Conexão com o banco de dados
require_once 'conect.php';  // Incluindo o arquivo de conexão
require_once 'header.php';

// Verificar se o ID do local foi passado na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_local = $_GET['id'];
} else {
    die("ID do local não especificado ou inválido.");
}

// Consulta para buscar os dados do local
$sql = "SELECT l.id_local, l.nome, l.endereco, l.descricao, l.foto, b.nome AS bairro, l.cidade, l.estado, l.latitude, l.longitude, l.horario_funcionamento
        FROM tb_local l
        LEFT JOIN tb_bairros b ON l.bairro = b.id_bairro
        WHERE l.id_local = ?";

// Preparar a consulta usando MySQLi
$stmt = $con->prepare($sql);

// Verificar se a preparação da consulta foi bem-sucedida
if (!$stmt) {
    die("Erro na preparação da consulta: " . $con->error);
}

// Vincular o parâmetro (id_local)
$stmt->bind_param("i", $id_local);

// Executar a consulta
$stmt->execute();

// Obter o resultado da consulta
$result = $stmt->get_result();

// Verificar se o local foi encontrado
if ($result->num_rows > 0) {
    $local = $result->fetch_assoc();
} else {
    die("Local não encontrado.");
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      margin-top: 150px;
      font-family: Arial, sans-serif;
      line-height: 1.6;
      background-color: #f4f4f4;
      color: #333;
    }

    header {
      background-color: #333;
      color: white;
      padding: 1rem 0;
    }

    .container {
      display: flex;
      justify-content: space-between;
      margin: 2rem;
      flex-wrap: wrap;
      margin: 0 auto;
    }

    .image-container {
      flex: 1;
      max-width: 40%;
      margin-right: 2rem;
      margin-bottom: 2rem;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .image-container img {
      width: 100%;
      height: auto;
    }

    .info-container {
      flex: 2;
      background-color: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
      position: relative;
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .location-address {
      font-size: 1rem;
      color: #555;
      margin-bottom: 1.5rem;
    }

    h2 {
      font-size: 1.5rem;
      color: #444;
      margin-top: 1.5rem;
    }

    .other-section {
      margin-top: 2rem;
      background-color: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .map-container {
      width: 100%;
      height: 400px;
      background-color: #e0e0e0;
      border-radius: 10px;
      margin-bottom: 2rem;
    }

    .ratings {
      margin-top: 2rem;
    }

    .review {
      border-bottom: 1px solid #eee;
      padding: 1rem 0;
    }

    .review p {
      margin-bottom: 0.5rem;
    }

    .review-form {
      margin-top: 2rem;
      padding: 1.5rem;
      background-color: #fafafa;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .review-form label {
      display: block;
      margin-bottom: 0.5rem;
    }

    .review-form select, .review-form textarea {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border-radius: 5px;
      border: 1px solid #ddd;
    }

    .review-form button {
      background-color: #333;
      color: white;
      border: none;
      padding: 1rem 2rem;
      border-radius: 5px;
      cursor: pointer;
    }

    .review-form button:hover {
      background-color: #444;
    }

    /* Estilo para o botão de favoritos */
    .favorite-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background-color: transparent;
        border: 2px solid #000;
        border-radius: 50%;
        padding: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        z-index: 5;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .favorite-btn i {
        font-size: 18px;
        color: #000;
        transition: color 0.3s ease;
    }

    .favorite-btn.active {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    .favorite-btn.active i {
        color: white;
    }

    .favorite-btn:hover {
        background-color: #f0f0f0;
        transform: scale(1.1);
    }
</style>

<body>
    <?php require_once 'nav.php'; ?>
  <div class="container">
    <!-- Imagem do local e Informações -->
    <div class="image-container img" style="background-image: url('<?php echo $local['foto']; ?>');">
    </div>


    <div class="info-container">
      <h1><?php echo $local['nome']; ?></h1>
      <p class="location-address">Endereço: <?php echo $local['endereco']; ?>, Bairro <?php echo $local['bairro']; ?>, <?php echo $local['cidade']; ?>, <?php echo $local['estado']; ?></p>

      <h2>Descrição do local</h2>
      <p><?php echo nl2br($local['descricao']); ?></p>

      <!-- Botão de Favoritos -->
      <button class="favorite-btn" id="favoriteButton">
        <i class="fa-regular fa-heart"></i>
      </button>
    </div>
  </div>

  <!-- Seção com Mapa e Avaliações -->
  <div class="other-section">
    <!-- Mapa -->
     <h2>Localização</h2>
    <div class="map-container">
        <iframe
            width="100%"
            height="400"
            frameborder="0" style="border:0"
            src="https://www.google.com/maps?q=<?php echo $local['latitude']; ?>,<?php echo $local['longitude']; ?>&z=15&output=embed"
            allowfullscreen>
        </iframe>
    </div>
    <a href="https://www.google.com/maps?q=<?php echo $local['latitude']; ?>,<?php echo $local['longitude']; ?>" target="_blank">
        <button class="btn btn-dark" style="padding: 10px 20px; font-size: 16px;">
            Ver no Google Maps
        </button>
    </a>

    <!-- Avaliações de Usuários -->
    <h2>Avaliações de Usuários</h2>
    <div class="ratings">
      <?php
      // Exemplo de exibição de avaliações:
      echo '<div class="review"><p><strong>João Silva</strong> (5 estrelas)</p><p>"Ótimo local! A quadra está sempre bem conservada!"</p></div>';
      ?>
    </div>
  </div>

  <script>
    const favoriteButton = document.getElementById('favoriteButton');
    const heartIcon = favoriteButton.querySelector('i');

    favoriteButton.addEventListener('click', () => {
        // Adiciona ou remove a classe 'active' no botão
        favoriteButton.classList.toggle('active');

        // Altera o ícone do coração
        if (favoriteButton.classList.contains('active')) {
            heartIcon.classList.remove('fa-regular');
            heartIcon.classList.add('fa-solid'); // Troca para o coração preenchido
        } else {
            heartIcon.classList.remove('fa-solid');
            heartIcon.classList.add('fa-regular'); // Troca para o coração vazio
        }
    });    
  </script>

  <?php require_once 'footer.php'; ?>
</body>
</html>
