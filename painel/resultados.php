<?php 
require_once 'header.php';
require_once 'nav.php';
require_once 'teste.php';
require_once 'pesquisa2.php';
?>

<style>
    .barra{
        border-radius: 5px;
        box-shadow: 0px 5px 5px 5px rgba(0, 0, 0, 0.11) !important;
        width: 100% !important;
    }

    .price{
        background-color: #004A6F !important;
    }

    .days{
        color: #004A6F !important;
    }

    .project-wrap .img .price:after {
        border-color: transparent transparent #004A6F transparent; 
    }

    .project-wrap .img .price:before {
        border-color: transparent transparent transparent #004A6F; 
    }

    .more2{
        margin-top: 15%;
        align-items: center;
    }

    .circle2{
        border: 4px solid #000;
        border-radius: 50%;
        width: 100px;
        height: 100px;
        background-color: transparent;
        transition: 1s ease;
        color: #000;
        margin-left: 40%;
    }

    .circle2:hover{
        background-color: #00aaff;
    }

    .circle2 i{
        font-size: 53px;
        color: #000 !important;
        display: inline-block;
        transition: transform 0.5s ease;
    }

    .circle2 i:hover{
        transform: rotate(-360deg);
    }

    .favorite-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background-color: rgba(255, 255, 255, 0.95);
        border: none;
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

    .favorite-btn:hover {
        background-color: #ffffff;
        transform: scale(1.1);
    }

    .favorite-btn i {
        font-size: 18px;
        color: #000;
        transition: color 0.3s ease;
    }

    .sugest {
        padding: 10px 22px; 
        font-size: 18px; 
        height: auto; 
    }

    .project-wrap .img .price:after{
        border-bottom-color: #004A6F !important;
    }

    .project-wrap .img .price:before{
        border-color: transparent transparent transparent #004A6F !important;
    }
</style>

<?php
require_once 'conexao.php';     

// Captura filtros
$esporte_id = $_GET['esporte'] ?? '';
$bairro_id  = $_GET['bairro']  ?? '';

// Monta a consulta
$query_locais = "
  SELECT l.*,
         e.nome AS esporte_nome,
         b.nome AS bairro_nome
    FROM tb_local l
    LEFT JOIN tb_local_esporte le ON l.id_local = le.id_local
    LEFT JOIN tb_esporte e ON le.id_esporte = e.id_esporte
    LEFT JOIN tb_bairros b ON l.bairro = b.id_bairro
   WHERE 1
";
if ($esporte_id !== '') {
  $e = $con->real_escape_string($esporte_id);
  $query_locais .= " AND e.id_esporte = '$e'";
}
if ($bairro_id !== '') {
  $b = $con->real_escape_string($bairro_id);
  $query_locais .= " AND l.bairro = '$b'";
}

$result_locais = $con->query($query_locais);
if (!$result_locais) {
  die("Erro na consulta: " . $con->error);
}

// Função de truncamento
function limitar_texto($t, $lim=20) {
  return strlen($t) > $lim ? substr($t,0,$lim).'...' : $t;
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<body>
    <section class="ftco-section" id="local">
    <div class="container">
      <div class="row justify-content-center pb-4">
        <div class="col-md-12 heading-section text-center ftco-animate">
          <h2 class="mb-4">Localizações</h2>
        </div>
      </div>

      <div class="row" id="cards-row">
        <?php
        if ($result_locais->num_rows > 0) {
          while ($l = $result_locais->fetch_assoc()) {
            // prepara dados
            $id_local     = $l['id_local'];
            $nome       = $l['nome'];
            $nome_trunc = limitar_texto($nome);
            $foto       = $l['foto'];
            $gratuito   = $l['gratuito'] ? 'Gratuito' : 'Pago';
            $esporte    = $l['esporte_nome'];
            $bairro_nome    = $l['bairro_nome']; // ou name se for texto
            $link       = "local.php?id=" . urlencode($id_local);

            echo '
            <div class="col-md-4 ftco-animate">
              <div class="project-wrap">
                <a href="'.$link.'" class="img" style="background-image:url(\''.$foto.'\');">
                  <span class="price">'.$gratuito.'</span>
                  <button class="favorite-btn" title="Favoritar">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                </a>
                <div class="text p-4 barra">
                  <span class="days" style="color: #004A6F">'.$esporte.'</span>
                  <h3><a href="'.$link.'">'.$nome_trunc.'</a></h3>
                  <p class="location"><i class="fa fa-map-marker"></i>'.$bairro_nome.'</p>
                  <a href="'.$link.'" class="btn btn-primary">Ver mais...</a>
                </div>
              </div>
            </div>';
          }
        } else {
          echo '<div class="col-12 text-center"><p>Nenhum local encontrado.</p></div>';
        }
        ?>
      </div>
    </div>
  </section>
  
  <?php 
        require_once 'footer.php';
    ?>
</body>


